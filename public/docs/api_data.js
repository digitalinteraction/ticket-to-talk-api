define({ "api": [
  {
    "type": "post",
    "url": "/articles/share/accept",
    "title": "Accept an Article.",
    "name": "AcceptArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article id</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "Article[]",
            "optional": false,
            "field": "The",
            "description": "<p>user's articles</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "get",
    "url": "/articles/destroy",
    "title": "Delete an Article",
    "name": "DeleteArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article id</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "get",
    "url": "/articles/share/get",
    "title": "Get Shared Articles",
    "name": "GetSharedArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "Article[]",
            "optional": false,
            "field": "Articles",
            "description": "<p>Articles shared with the user.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "get",
    "url": "/articles/all",
    "title": "Get User's Articles",
    "name": "GetUserArticles",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "Article[]",
            "optional": false,
            "field": "articles",
            "description": "<p>User's articles</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "post",
    "url": "/articles/share/reject",
    "title": "Reject an Article.",
    "name": "RejectArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article id</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "post",
    "url": "/articles/share/send",
    "title": "Share an Article.",
    "name": "ShareArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>The recipient's email address.</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "get",
    "url": "/articles/show",
    "title": "Get an Article",
    "name": "ShowArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article ID</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "Article",
            "optional": false,
            "field": "article",
            "description": "<p>The requested article</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "post",
    "url": "/articles/store",
    "title": "Store an Article",
    "name": "StoreArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "Article",
            "optional": false,
            "field": "article",
            "description": "<p>The stored article</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>Owner of the article</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  },
  {
    "type": "post",
    "url": "/articles/update",
    "title": "Update an Article",
    "name": "UpdateArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "article_id",
            "description": "<p>The article id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>The article title</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>The article title</p>"
          },
          {
            "group": "Parameter",
            "type": "Notes",
            "optional": false,
            "field": "notes",
            "description": "<p>The user's notes on the article</p>"
          },
          {
            "group": "Parameter",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>HTTP response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "Article",
            "optional": false,
            "field": "article",
            "description": "<p>The requested article</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "500",
            "description": "<p>The article could not be found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  }
] });
