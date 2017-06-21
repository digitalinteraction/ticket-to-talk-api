const mysql = require("mysql");
const moment = require('moment');
const dbHelper = require("./database");
const ss = require("simple-statistics");

let t  =
{
	/**
	 * [get_tickets description]
	 * @param  {[type]} con [description]
	 * @return {[type]}     [description]
	 */
	getTickets: async function(con)
	{

	    let query = "SELECT * FROM ticket_logs LEFT JOIN tickets ON ticket_logs.ticket_id = tickets.id ORDER BY ticket_logs.id";
		let result = await dbHelper.executeQuery(con, query);

        let tickets = [];
        for(let r of result)
        {

            let start = moment(r.start, "YYYY-MM-DDTHH:mm:ss.000Z");
            let finish = moment(r.finish, "YYYY-MM-DDTHH:mm:ss.000Z");
            let ticket_length = finish.diff(start, 'seconds');
            let t =
            {
                id: r.id,
                ticket_id:r.ticket_id,
                duration: ticket_length,
                type: r.mediaType
            }

            tickets.push(t);
        }

		return tickets;
	},

	durationAverage: function(tickets)
	{
		let durations = this.durationToArray(tickets);
		return ss.mean(durations).toFixed(2);
	},

	durationMin: function(tickets)
	{
		let durations = this.durationToArray(tickets);
		return ss.min(durations).toFixed(2);
	},

	durationMax: function(tickets)
	{
		let durations = this.durationToArray(tickets);
		return ss.max(durations).toFixed(2);
	},

	durationSD: function(tickets)
	{
		let durations = this.durationToArray(tickets);
		return ss.standardDeviation(durations).toFixed(2);
	},

	ticketTypeDistribution: function(tickets)
	{
	    let ticketTypes = new Set();
	    let distCounts = {};

	    for (let t of tickets)
	    {
	        ticketTypes.add(t.type);
	        distCounts[t.type] = 0;
	    }

	    for (let t of tickets)
	    {
	        distCounts[t.type] += 1;
	    }

	    let dists = "";
	    for(key in distCounts){
	        let dist = (distCounts[key] / tickets.length) * 100;
	        dist = dist.toFixed(2);

	        let str = "\t" + key + ":\t" + dist + "%\n";
	        dists += str;
	    }

	    return dists;
	},

	durationToArray: function(tickets)
	{
		let durs = [];

		for (let t of tickets)
		{
			durs.push(t.duration);
		}

		return durs;
	},

	generateReport: function(tickets)
	{
		console.log("-------------------------------------");
	    console.log("TICKETS");
	    console.log("-------------------------------------");
	    console.log("TICKETS USED:               ", tickets.length);
	    console.log("DURATION:");
		console.log("\tMIN:\t", this.durationMin(tickets)),
	    console.log("\tMAX:\t", this.durationMax(tickets)),
	    console.log("\tMEAN:\t", this.durationAverage(tickets));
	    console.log("\tSD:\t", this.durationSD(tickets));
	    let dists = this.ticketTypeDistribution(tickets);
	    console.log("TICKET DISTRIBUTION:");
	    console.log(dists);
	}
};

module.exports = t;
