define({ "api": [
  {
    "type": "get",
    "url": "/articles/store",
    "title": "Store an Article",
    "name": "StoreArticle",
    "group": "Articles",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "token",
            "optional": false,
            "field": "Session",
            "description": "<p>token</p>"
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
            "description": "<p>Owner of the article</p> <p>Store a newly created resource in storage.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ArticleController.php",
    "groupTitle": "Articles"
  }
] });
