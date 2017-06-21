const moment = require('moment');
const mysql = require("mysql");
const dbHelper = require("./database");
const ss = require("simple-statistics");

let c =
{
	/**
	 * Get the total number of recorded conversations
	 * @param  {MySQLConnection} con A connection to a MySQL database.
	 * @return {Promise}     The number of conversations
	 */
	getConversations: async function(con)
	{
		let query = "SELECT * FROM conversation_logs";

		let result = await dbHelper.executeQuery(con, query);

		let conversations = [];
		for(let r of result)
		{
			let start = moment(r.start, "YYYY-MM-DDTHH:mm:ss.000Z");
			let finish = moment(r.finish, "YYYY-MM-DDTHH:mm:ss.000Z");
			let conv_length = finish.diff(start, 'seconds');
			let c =
			{
				id: r.id,
				conversation_id:r.conversation_id,
				duration: conv_length
			}

			conversations.push(c);
		}

		return conversations;
	},

	durationAverage: function(conversations)
	{
		let durations = this.durationToArray(conversations);
		return ss.mean(durations).toFixed(2);
	},

	durationMin: function(conversations)
	{
		let durations = this.durationToArray(conversations);
		return ss.min(durations).toFixed(2);
	},

	durationMax: function(conversations)
	{
		let durations = this.durationToArray(conversations);
		return ss.max(durations).toFixed(2);
	},

	durationSD: function(conversations)
	{
		let durations = this.durationToArray(conversations);
		return ss.standardDeviation(durations).toFixed(2);
	},

	/**
	 * Count the number of unique conversations
	 * @param  {Conversation[]} conversations Total conversations
	 * @return {int}               Total number of unique conversations.
	 */
	uniqueConversationsCount: function(conversations)
	{
	    let unique_convs = new Set();

	    for (let c of conversations)
	    {
	        unique_convs.add(c.conversation_id);
	    }

	    return unique_convs.size;
	},

	durationToArray: function(conversations)
	{
		let durs = [];

		for (let c of conversations)
		{
			durs.push(c.duration);
		}

		return durs;
	},

	generateReport: function(conversations)
	{
		console.log("-------------------------------------");
	    console.log("CONVERSATIONS");
	    console.log("-------------------------------------");
	    console.log("NUMBER OF CONVERSATION LOGS:", conversations.length);
	    console.log("UNIQUE CONVERSATIONS:       ", this.uniqueConversationsCount(conversations));
	    console.log("DURATION:");
	    console.log("\tMIN:\t", this.durationMin(conversations)),
	    console.log("\tMAX:\t", this.durationMax(conversations)),
	    console.log("\tMEAN:\t", this.durationAverage(conversations));
	    console.log("\tSD:\t", this.durationSD(conversations));
	}
};

module.exports = c;
