<!DOCTYPE html>
<html>
<head>
  <script async src="https://www.googletagmanager.com/gtag/js"></script>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>

  <script>
    var tracker = 'UA-99833865-1';
    window['ga-disable-'+tracker] = true;

    function enableGA()
    {
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', tracker, { 'anonymize_ip': true });
        window['ga-disable-'+tracker] = false;
    }

    function disableGA()
    {
        window['ga-disable-'+tracker] = true;
    }

    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
    "palette": {
        "popup": {
        "background": "#00CECB",
        "text": "#fff"
        },
        "button": {
        "background": "#fff",
        "text": "#00CECB"
        }
    },
    "position": "bottom-right",
    "type": "opt-in",
    "content": {
        "message": "This website uses a cookie for Google Analytics to aid our understanding of how people use Ticket to Talk.",
        "link": "Learn More",
        "href": "/cookies",
        "dismiss":"Decline"
    },
    onInitialise: function (status) {
    var type = this.options.type;
    var didConsent = this.hasConsented();
    if (type == 'opt-in' && status=='allow' && didConsent) {
        // enable cookies
        enableGA();
    }

    },

    onStatusChange: function(status, chosenBefore) {
        var type = this.options.type;
        var didConsent = this.hasConsented();

        if (type == 'opt-in' && status=='allow' && didConsent) {
            // enable cookies
            enableGA();
        }
    },

    onRevokeChoice: function() {
        // console.log("revoke");

    var type = this.options.type;
        if (type == 'opt-in') {
            // disable cookies
            disableGA();
        }
    },
    })});
  </script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">

    <!--Import Bulma -->
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Ticket to Talk | Research</title>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: Privacy Policy">
</head>

<body>

  <section class="hero is-medium title-banner">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Ticket to Talk</h1>
        <h2 class="subtitle">Research</h2>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="content">
        <p>
          This service is part of a research project by Open Lab, Newcastle University.
        </p>
        <p>
          We may collect data on how you interact with the service and use this is research.
        </p>
        <p>
          We often publish academic papers which may contain aggregated user data. Our published findings will never include information that could be used to identify users of the system.
        </p>

        <h2>Contact Information:</h2>
        <p>
          Should you have any questions, contact us:
        </p>

        <p>
          <strong>Address:</strong><br  />
          Open Lab<br  />
          Floor 1<br  />
          Urban Sciences Building<br  />
          1 Science Square<br  />
          Science Central<br  />
          Newcastle Upon Tyne<br  />
          NE4 5TG<br  />
        </p>

        <p>
          <strong>Phone:</strong> +44 191 20 84642 | 84630 <br />
          <strong>Email:</strong> <a href="mailto:openlab-admin@newcastle.ac.uk">openlab-admin@newcastle.ac.uk</a>
        </p>

        <h2>Effective Date:</h2>
        <p>
          May 25, 2018
        </p>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <div id="logos" class="columns">
          <div class="column is-2">
            <img src="/images/NewcastleUni_white.png" class="col s2 responsive-img" alt="Newcastle University"/>
          </div>
          <div class="column is-2">
            <img src="/images/ESRC_white.png" class="col s2 responsive-img" alt="ESRC"/>
          </div>
          <div class="column is-2">
            <img src="/images/EPSRC_white.png" class="col s2 responsive-img" alt="EPSRC"/>
          </div>
          <div class="column is-2">
            <img src="/images/NewcastleUniNISR_white.png" class="col s2 responsive-img" alt="Newcastle University ISR"/>
          </div>
          <div class="column is-2">
            <img src="/images/DigitalEconomy_white.png" class="col s2 responsive-img" alt="Digital Economy"/>
          </div>
          <div class="column is-2">
            <img src="/images/YFNE_white.png" class="col s2 responsive-img" alt="Youth Focus North East"/>
          </div>
        </div>
        <div class="footer-copyright">
            <div class="container" style="text-decoration: none;">
        <a class="col s2" href="https://ticket-to-talk.com/privacy">
          Privacy
        </a>
        |
        <a class="col s2" href="https://ticket-to-talk.com/terms">
          Terms
        </a>
        |
        <a class="col s2" href="mailto:d.welsh@ncl.ac.uk">
          Contact
        </a>
        |
        <a class="col s2" href="/research">
          Research
        </a>
            </div>
          </div>
          <div id="copyright">
            &copy; Open Lab, Newcastle University 2017
          </div>
      </div>
    </div>
  </footer>

</body>
</html>
