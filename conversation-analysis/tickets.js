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

	uniqueTicketsCount: function(tickets)
	{
	    let uniqueTickets = new Set();

	    for (let t of tickets)
	    {
	        uniqueTickets.add(t.ticket_id);
	    }

	    return uniqueTickets.size;
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

	    for(key in distCounts){
	        distCounts[key] = (distCounts[key] / tickets.length) * 100;
	        distCounts[key] = distCounts[key].toFixed(2);
	    }

	    return distCounts;
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

	printReport: function(tickets)
	{
		console.log("-------------------------------------");
	    console.log("TICKETS");
	    console.log("-------------------------------------");
	    console.log("Tickets Used:               ", tickets.length);
		console.log("Unique Tickets:             ", tickets.length);
	    console.log("Duration (Seconds):");
		console.log("\tMin:\t", this.durationMin(tickets)),
	    console.log("\tMax:\t", this.durationMax(tickets)),
	    console.log("\tMean:\t", this.durationAverage(tickets));
	    console.log("\tSD:\t", this.durationSD(tickets));
	    let dists = this.ticketTypeDistribution(tickets);
	    console.log("Type Distribution:");
	    console.log(dists);
	},

	generateReport: function(tickets)
	{

		let r =
		{
			total: tickets.length,
			unique: this.uniqueTicketsCount(tickets),
			duration:
			{
				min: this.durationMin(tickets),
				max: this.durationMax(tickets),
				mean: this.durationAverage(tickets),
				sd: this.durationSD(tickets)
			},
			distribution: this.ticketTypeDistribution(tickets)
		};

		return r;
	}
};

module.exports = t;
