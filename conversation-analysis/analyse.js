const databaseHelper = require("./database");
const ticketHelper = require("./tickets");
const conversationHelper = require("./conversations");

/**
 * Main method
 * @constructor
 * @return      {null}
 */
async function __main__()
{
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

    conversationHelper.generateReport(conversations);
    console.log("\n");
    ticketHelper.generateReport(tickets);
}

__main__();
