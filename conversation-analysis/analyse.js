const databaseHelper = require("./database");
const ticketHelper = require("./tickets");
const conversationHelper = require("./conversations");
const fs = require('fs');

function createJSONStub() {
	let stub = {
		records: []
	};

	stub = JSON.stringify(stub);

	return new Promise(function(resolve, reject) {
		fs.writeFile('analytic_logs.json', stub, 'utf8', (err) => {
			if (err) reject(err);

			resolve(true);
		});
	});
}

async function storeRecord(record)
{
    let logs;

    try {
        logs = await getLogs("analytic_logs.json");
    } catch (e) {
        console.log(e);
        exit(1);
    }

    logs.records.push(record);
    logs = JSON.stringify(logs, null, 4);

    return new Promise(function(resolve, reject) {
		fs.writeFile('analytic_logs.json', logs, 'utf8', (err) => {
			if (err) reject(err);

			resolve(true);
		});
	});

}

function getLogs(fileName) {

    return new Promise(function(resolve, reject) {
        fs.readFile(fileName, 'utf8', function readFileCallback(err, data) {
    		if (err) {
    			reject(err);
    		} else {
    			obj = JSON.parse(data); //now it an object

                resolve(obj);
    		}
    	});
    });
}

/**
 * Main method
 * @constructor
 * @return      {null}
 */
async function __main__() {
	let con, conversations, tickets;

	try {
		con = databaseHelper.getConnection();
		con.connect();
		conversations = await conversationHelper.getConversations(con);
		tickets = await ticketHelper.getTickets(con);
	} catch (e) {
		console.error(e);
		exit();
	}

	con.end();

	let c, r, t;

	try {
		c = conversationHelper.generateReport(conversations);
		t = ticketHelper.generateReport(tickets);
	} catch (e) {
		console.error(e);
	}

	if (c != null && t != null) {
		r = {
			date: new Date().toLocaleString(),
			conversations: c,
			tickets: t
		}

		console.log(JSON.stringify(r, null, 4));

        let stored = await storeRecord(r);
        if (stored)
        {
            console.log("stored");
        }
        else
        {
            exit(1);
        }
	}
}

__main__();
