require('dotenv').config();
const mysql = require("mysql");

let d =
{
	/**
	 * Get a connection to the database
	 * @return {MySQLConnection} A connection to the mysql database.
	 */
	getConnection: function()
	{
	    let con = mysql.createConnection({
	        host: process.env.DB_HOST,
	        user: process.env.DB_USERNAME,
	        password: process.env.DB_PASSWORD,
	        database: process.env.DB_DATABASE
	    });

	    return con;
	},

	executeQuery: function(con, query)
	{
		return new Promise(function(resolve, reject) {

	        con.query(query, function (err, result, fields) {
	            if (err) reject(err);

	            resolve(result);
	        });
	    });
	}
};

module.exports = d;
