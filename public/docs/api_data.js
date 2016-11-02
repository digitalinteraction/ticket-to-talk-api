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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"Status\": 200,\n           \"Message\": \"Article accepted\",\n           \"Articles\": [\n               {\n                   \"id\": 1,\n                   \"title\": \"Facebook\",\n                   \"link\": \"http://facebook.com\",\n                   \"notes\": \"Add some notes about the article!\",\n                   \"created_at\": \"2016-10-21 09:55:36\",\n                   \"updated_at\": \"2016-10-21 10:37:50\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 1\n                   }\n               },\n               {\n                   \"id\": 2,\n                   \"title\": \"Facebook\",\n                   \"link\": \"facebook.com\",\n                   \"notes\": \"These are notes\",\n                   \"created_at\": \"2016-10-21 10:17:35\",\n                   \"updated_at\": \"2016-10-21 10:17:35\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 2\n                   }\n               },\n               {\n                   \"id\": 5,\n                   \"title\": \"Article\",\n                   \"link\": \"http://google.com\",\n                   \"notes\": \"These are updated notes\",\n                   \"created_at\": \"2016-10-21 10:23:22\",\n                   \"updated_at\": \"2016-10-21 10:28:46\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 5\n                   }\n               }\n           ]\n       }",
          "type": "json"
        }
      ]
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
    "type": "delete",
    "url": "/articles/destroy",
    "title": "Delete an Article",
    "name": "DeleteArticle",
    "group": "Articles",
    "success": {
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"status\": 200,\n           \"message\": \"Article deleted\"\n       }",
          "type": "json"
        }
      ],
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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"Status\": 200,\n           \"Articles\": [\n               {\n                   \"id\": 1,\n                   \"title\": \"Facebook\",\n                   \"link\": \"http://facebook.com\",\n                   \"notes\": \"Add some notes about the article!\",\n                   \"created_at\": \"2016-10-21 09:55:36\",\n                   \"updated_at\": \"2016-10-21 10:37:50\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 1\n                   }\n               },\n               {\n                   \"id\": 2,\n                   \"title\": \"Facebook\",\n                   \"link\": \"facebook.com\",\n                   \"notes\": \"These are notes\",\n                   \"created_at\": \"2016-10-21 10:17:35\",\n                   \"updated_at\": \"2016-10-21 10:17:35\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 2\n                   }\n               },\n           ]\n       }",
          "type": "json"
        }
      ]
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
    "description": "<p>Get the user's saved articles</p>",
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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"status\": {\n               \"message\": \"Success\",\n               \"code\": 200\n           },\n           \"errors\": [],\n           \"data\": {\n               \"articles\": [\n                   {\n                       \"id\": 2,\n                       \"title\": \"Facebook\",\n                       \"link\": \"facebook.com\",\n                       \"notes\": \"These are notes\",\n                       \"created_at\": \"2016-10-21 10:17:35\",\n                       \"updated_at\": \"2016-10-21 10:17:35\",\n                       \"pivot\": {\n                           \"user_id\": 3,\n                           \"article_id\": 2\n                       }\n                   },\n                   {\n                       \"id\": 5,\n                       \"title\": \"Article\",\n                       \"link\": \"http://google.com\",\n                       \"notes\": \"These are updated notes\",\n                       \"created_at\": \"2016-10-21 10:23:22\",\n                       \"updated_at\": \"2016-10-21 10:28:46\",\n                       \"pivot\": {\n                           \"user_id\": 3,\n                           \"article_id\": 5\n                       }\n                   }\n               ]\n           }\n       }",
          "type": "json"
        }
      ]
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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"Status\": 200,\n           \"Message\": \"Article rejected\"\n       }",
          "type": "json"
        }
      ]
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
    "description": "<p>Get a single article by its ID.</p>",
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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"status\": {\n               \"message\": \"Returned users articles\",\n               \"code\": 200\n           },\n           \"errors\": [],\n           \"data\": {\n               \"article\": {\n                   \"id\": 5,\n                   \"title\": \"Article\",\n                   \"link\": \"http://google.com\",\n                   \"notes\": \"These are updated notes\",\n                   \"created_at\": \"2016-10-21 10:23:22\",\n                   \"updated_at\": \"2016-10-21 10:28:46\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 5\n                   }\n               }\n           }\n       }",
          "type": "json"
        }
      ]
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
    "description": "<p>Create and save an article</p>",
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
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n           \"status\": {\n               \"message\": \"Article saved.\",\n               \"code\": 200\n           },\n           \"errors\": [],\n           \"data\": {\n               \"article\": {\n                   \"title\": \"Facebook\",\n                   \"link\": \"facebook.com\",\n                   \"notes\": \"These are notes\",\n                   \"updated_at\": \"2016-10-21 10:23:22\",\n                   \"created_at\": \"2016-10-21 10:23:22\",\n                   \"id\": 5\n               },\n               \"owner\": {\n                   \"id\": 3,\n                   \"name\": \"Test\",\n                   \"email\": \"test@email.com\",\n                   \"pathToPhoto\": \"ticket_to_talk/storage/profile/u_3.jpg\",\n                   \"created_at\": \"2016-10-20 15:16:03\",\n                   \"updated_at\": \"2016-10-20 15:16:04\",\n                   \"imageHash\": \"asdasdasdasdasdasdasdsdasdasd\",\n                   \"revoked\": null\n               }\n           }\n       }",
          "type": "json"
        }
      ]
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
    "description": "<p>Update an article with new information.</p>",
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
      },
      "examples": [
        {
          "title": "Server-Response:",
          "content": "{\n           \"status\": {\n               \"message\": \"Article updated\",\n               \"code\": 200\n           },\n           \"errors\": [],\n           \"data\": {\n               \"article\": {\n                   \"id\": 5,\n                   \"title\": \"Article\",\n                   \"link\": \"http://google.com\",\n                   \"notes\": \"These are updated notes\",\n                   \"created_at\": \"2016-10-21 10:23:22\",\n                   \"updated_at\": \"2016-10-21 10:28:46\",\n                   \"pivot\": {\n                       \"user_id\": 3,\n                       \"article_id\": 5\n                   }\n               }\n           }\n       }",
          "type": "json"
        }
      ]
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
    "url": "/auth/login",
    "title": "Login",
    "name": "Login",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The user's email address.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>A hashed version of the user's password.</p>"
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
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>The newly created user.</p>"
          },
          {
            "group": "Success 200",
            "type": "JWTAuthToken",
            "optional": false,
            "field": "token",
            "description": "<p>The session token</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "api_key",
            "description": "<p>Returns the user's api key if they login with the default key.</p>"
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
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/AuthController.php",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/auth/register",
    "title": "Register",
    "name": "Register",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>The user's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The user's email address.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>A hashed version of the user's password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pathToPhoto",
            "description": "<p>Path to the user's photo.</p>"
          },
          {
            "group": "Parameter",
            "type": "byte[]",
            "optional": false,
            "field": "image",
            "description": "<p>The user's profile picture as a byte array.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "imageHash",
            "description": "<p>A SHA256 of the image byte array.</p>"
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
            "field": "message",
            "description": "<p>Server message</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>The newly created user.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "api_key",
            "description": "<p>The user's api_key</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>The user's session token.</p>"
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
            "description": "<p>User could not be created.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/AuthController.php",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/conversations/tickets/add",
    "title": "Add a Ticket to a Conversation",
    "name": "AddTicketToConversation",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "conversation_id",
            "description": "<p>Conversation identifier.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ticket_id",
            "description": "<p>Ticket identifier.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Deletion confirmation</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "get",
    "url": "/conversations/destroy",
    "title": "Delete a Conversation",
    "name": "DeleteConversation",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "conversation_id",
            "description": "<p>Conversation identifier.</p>"
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
            "field": "Status",
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>Deletion confirmation</p>"
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
            "description": "<p>Conversation not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "get",
    "url": "/conversations/get",
    "title": "Get User's Conversations",
    "name": "GetConversations",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>The id of the person the conversations are for.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "Conversation[]",
            "optional": false,
            "field": "conversations",
            "description": "<p>The conversations attached to the person.</p>"
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
            "description": "<p>Person could not be found</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "post",
    "url": "/conversations/tickets/remove",
    "title": "Remove a Ticket from a Conversation",
    "name": "RemoveTicketFromConversation",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "conversation_id",
            "description": "<p>Conversation identifier.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ticket_id",
            "description": "<p>Ticket identifier.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Deletion confirmation</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "post",
    "url": "/conversations/store",
    "title": "Save a Conversation",
    "name": "StoreConversation",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "datetime",
            "description": "<p>String representation of the conversation date-time.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "platform",
            "description": "<p>The OS the request is sent from (Android or iOS).</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notes",
            "description": "<p>The user's notes on the conversation.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>ID of the person this conversation is for.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "Conversation",
            "optional": false,
            "field": "conversation",
            "description": "<p>The newly created conversation.</p>"
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
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "post",
    "url": "/conversations/update",
    "title": "Update a Conversation",
    "name": "UpdateConversation",
    "group": "Conversations",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "conversation_id",
            "description": "<p>Conversation identifier.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notes",
            "description": "<p>The user's notes on the conversation.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "Conversation",
            "optional": false,
            "field": "Conversation",
            "description": "<p>The updated conversation.</p>"
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
            "description": "<p>Conversation not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ConversationController.php",
    "groupTitle": "Conversations"
  },
  {
    "type": "get",
    "url": "/inspiration/get",
    "title": "Get Inspirations",
    "name": "GetInspirations",
    "group": "Inspiration",
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
            "type": "Inspiration[]",
            "optional": false,
            "field": "Inspirations",
            "description": "<p>Array of Inspirations.</p>"
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
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/InspirationController.php",
    "groupTitle": "Inspiration"
  },
  {
    "type": "get",
    "url": "/media/get",
    "title": "Download Media",
    "name": "GetMedia",
    "group": "Media",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fileName",
            "description": "<p>Path to the file.</p>"
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
            "type": "File",
            "optional": false,
            "field": "Returns",
            "description": "<p>the requested file</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/MediaController.php",
    "groupTitle": "Media"
  },
  {
    "type": "delete",
    "url": "/people/destroy",
    "title": "Delete a Person",
    "name": "DeletePerson",
    "group": "People",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>Person's ID.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Deletion confirmation</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "get",
    "url": "/people/show",
    "title": "Get People",
    "name": "GetPeople",
    "group": "People",
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
            "description": "<p>The response code</p>"
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
            "type": "Person[]",
            "optional": false,
            "field": "person",
            "description": "<p>The user's people</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "get",
    "url": "/people/tickets",
    "title": "Get a Person's Tickets",
    "name": "GetTicketsForPerson",
    "group": "People",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>Person's ID.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "Ticket[]",
            "optional": false,
            "field": "tickets",
            "description": "<p>Get a person's tickets.</p>"
          },
          {
            "group": "Success 200",
            "type": "Tag[]",
            "optional": false,
            "field": "tags",
            "description": "<p>Get tags for tickets.</p>"
          },
          {
            "group": "Success 200",
            "type": "TicketTag[]",
            "optional": false,
            "field": "ticket_tags",
            "description": "<p>Get ticket tag pairing.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "get",
    "url": "/people/getusers",
    "title": "Get Person's Attached Users",
    "name": "PersonUsers",
    "group": "People",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>Person's ID.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "User[]",
            "optional": false,
            "field": "users",
            "description": "<p>Users attached to this person.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "post",
    "url": "/people/store",
    "title": "Save a person",
    "name": "StorePerson",
    "group": "People",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Person's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthYear",
            "description": "<p>Person's birth year.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthPlace",
            "description": "<p>Person's birth place.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notes",
            "description": "<p>User's notes on the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "townCity",
            "description": "<p>Where the person spent most of their life.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "relation",
            "description": "<p>User's relation to the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "byte[]",
            "optional": false,
            "field": "image",
            "description": "<p>Picture of the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "imageHash",
            "description": "<p>SHA256 hash of the image byte array.</p>"
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
            "description": "<p>The response code</p>"
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
            "type": "Person",
            "optional": false,
            "field": "person",
            "description": "<p>The newly created person.</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "owner",
            "description": "<p>The user who created the person.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "post",
    "url": "/people/update",
    "title": "Update a Person",
    "name": "UpdatePerson",
    "group": "People",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>Person's ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Person's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthYear",
            "description": "<p>Person's birth year.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "birthPlace",
            "description": "<p>Person's birth place.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notes",
            "description": "<p>User's notes on the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "townCity",
            "description": "<p>Where the person spent most of their life.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "relation",
            "description": "<p>User's relation to the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "byte[]",
            "optional": false,
            "field": "image",
            "description": "<p>Picture of the person.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "imageHash",
            "description": "<p>SHA256 hash of the image byte array.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Update confirmation</p>"
          },
          {
            "group": "Success 200",
            "type": "Person",
            "optional": false,
            "field": "person",
            "description": "<p>The newly created person.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PersonController.php",
    "groupTitle": "People"
  },
  {
    "type": "delete",
    "url": "/tickets/destroy",
    "title": "Delete a Ticket",
    "name": "DeleteTicket",
    "group": "Tickets",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ticket_id",
            "description": "<p>The ticket id.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Update confirmation</p>"
          },
          {
            "group": "Success 200",
            "type": "Ticket",
            "optional": false,
            "field": "ticket",
            "description": "<p>The newly created ticket.</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>The owner of the ticket.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/TicketController.php",
    "groupTitle": "Tickets"
  },
  {
    "type": "post",
    "url": "/tickets/store",
    "title": "Save a Ticket",
    "name": "SaveTicket",
    "group": "Tickets",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Ticket",
            "optional": false,
            "field": "ticket",
            "description": "<p>The ticket to save.</p>"
          },
          {
            "group": "Parameter",
            "type": "Period",
            "optional": false,
            "field": "period",
            "description": "<p>Period of life the ticket is from.</p>"
          },
          {
            "group": "Parameter",
            "type": "byte[]",
            "optional": false,
            "field": "media",
            "description": "<p>Byte array of the file attached to the ticket.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Update confirmation</p>"
          },
          {
            "group": "Success 200",
            "type": "Ticket",
            "optional": false,
            "field": "ticket",
            "description": "<p>The newly created ticket.</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>The owner of the ticket.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/TicketController.php",
    "groupTitle": "Tickets"
  },
  {
    "type": "post",
    "url": "/tickets/update",
    "title": "Update a Ticket",
    "name": "UpdateTicket",
    "group": "Tickets",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ticket_id",
            "description": "<p>The ticket id.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>The ticket title.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>The ticket description.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "year",
            "description": "<p>The year the file is from.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "access_level",
            "description": "<p>Which user group can access the ticket.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "period_id",
            "description": "<p>The id of the period the ticket is from.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "area",
            "description": "<p>Where the ticket is from.</p>"
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
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Update confirmation</p>"
          },
          {
            "group": "Success 200",
            "type": "Ticket",
            "optional": false,
            "field": "ticket",
            "description": "<p>The newly created ticket.</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "user",
            "description": "<p>The owner of the ticket.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/TicketController.php",
    "groupTitle": "Tickets"
  },
  {
    "type": "post",
    "url": "/user/invitations/accept",
    "title": "Accept and Invitation",
    "name": "AcceptPersonInvitation",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>The person's ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "relation",
            "description": "<p>The user's relation to the person.</p>"
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
            "field": "Status",
            "description": "<p>The response code.</p>"
          },
          {
            "group": "Success 200",
            "type": "Person",
            "optional": false,
            "field": "person",
            "description": "<p>The person the user accepted the invite for.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/invitations/get",
    "title": "Get a User's Invitations",
    "name": "GetPersonInvitation",
    "group": "User",
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
            "type": "Invitation[]",
            "optional": false,
            "field": "invites",
            "description": "<p>The user's invitations.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/getpeople",
    "title": "Get A User's People",
    "name": "GetUsersPeople",
    "group": "User",
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
            "type": "Person[]",
            "optional": false,
            "field": "people",
            "description": "<p>The people linked to the user's account.</p>"
          },
          {
            "group": "Success 200",
            "type": "Period[]",
            "optional": false,
            "field": "periods",
            "description": "<p>The periods attached to these people.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/invitations/reject",
    "title": "Reject an Invitation",
    "name": "RejectPersonInvitation",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>The person's ID.</p>"
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
            "field": "Status",
            "description": "<p>The response code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Messages",
            "description": "<p>Server message.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/invitations/send",
    "title": "Invite a User to Join a Person",
    "name": "SendPersonInvitation",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "person_id",
            "description": "<p>The person's ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The recipient's email address.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "group",
            "description": "<p>The user group the recipient is to join.</p>"
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
            "description": "<p>The response code.</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "added",
            "description": "<p>Whether the invitation was successful.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/update",
    "title": "Update a User",
    "name": "UpdateUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>The user's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The user's email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Hashed version of the user's password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "imageHash",
            "description": "<p>SHA256 Hash of the user's profile photo.</p>"
          },
          {
            "group": "Parameter",
            "type": "byte[]",
            "optional": false,
            "field": "image",
            "description": "<p>Byte array of the user's profile picture.</p>"
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
            "field": "Status",
            "description": "<p>The response code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>Update confirmation</p>"
          },
          {
            "group": "Success 200",
            "type": "User",
            "optional": false,
            "field": "User",
            "description": "<p>The updated user.</p>"
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
            "description": "<p>Resource not found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401",
            "description": "<p>User could not be authenticated</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  }
] });
