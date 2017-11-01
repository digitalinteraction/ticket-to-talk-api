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
		let query = "SELECT * FROM conversation_logs LEFT JOIN conversations ON conversation_logs.conversation_id = conversations.id ORDER BY conversation_logs.id";

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
				duration: conv_length,
				user_id: r.user_id,
				person_id: r.person_id
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

	uniqueUsersCount: function(conversations)
	{
		let uniqueUsers = new Set();

	    for (let c of conversations)
	    {
	        uniqueUsers.add(c.user_id);
	    }

	    return uniqueUsers.size;
	},

	uniquePeopleCount: function(conversations)
	{
		let uniquePeople = new Set();

	    for (let c of conversations)
	    {
	        uniquePeople.add(c.person_id);
	    }

	    return uniquePeople.size;
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

	printReport: function(r)
	{
		console.log("-------------------------------------");
	    console.log("CONVERSATIONS");
	    console.log("-------------------------------------");
	    console.log("Total Conversations:        ", r.total);
	    console.log("Unique Conversations:       ", r.unique);
		console.log("Unique Users:               ", r.uniqueUsers);
		console.log("Unique People:              ", r.uniquePeople);
	    console.log("Duration (Seconds):");
	    console.log("\tMin:\t", r.minDuration),
	    console.log("\tMax:\t", r.maxDuration),
	    console.log("\tMean:\t", r.meanDuration);
	    console.log("\tSD:\t", r.durationSD);
	},

	generateReport: function(conversations)
	{

		let r =
		{
			total: conversations.length,
			unique: this.uniqueConversationsCount(conversations),
			uniqueUsers: this.uniqueUsersCount(conversations),
			uniquePeople: this.uniquePeopleCount(conversations),
			minDuration: this.durationMin(conversations),
			maxDuration: this.durationMax(conversations),
			meanDuration: this.durationAverage(conversations),
			durationSD: this.durationSD(conversations)
		};

		return r;
	}
};

module.exports = c;
