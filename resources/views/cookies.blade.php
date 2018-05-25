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

    <!--Import Bulma -->
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Ticket to Talk | Cookies</title>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: Privacy Policy">
</head>

<body>

  <section class="hero is-medium title-banner">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Ticket to Talk</h1>
        <h2 class="subtitle">Cookie Policy</h2>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="content">
        <p>
          To make this site work properly, we sometimes place small data files called cookies on your device. Most big websites do this too.
          What are cookies?
        </p>

        <p>
          A cookie is a small text file that a website saves on your computer or mobile device when you visit the site. It enables the website to remember your actions and preferences (such as login, language, font size and other display preferences) over a period of time, so you don’t have to keep re-entering them whenever you come back to the site or browse from one page to another.
          How do we use cookies?
        </p>

        <p>
          We use cookies for a variety of reasons, not only do they help to provide a better user experience they allow us to collect information about how people use the service. This information is then used to improve the service and published in academic papers.
        </p>

        <p>
          Authentication We use cookies when you sign in to the site, this helps us remember who is currently authenticated so you can access your profile and content. Any action you perform when authenticated relies on cookies to work correctly.
        </p>

        <p>
          Preferences We may use cookies to remember any preferences you have set whilst on the site, this might include which language you are viewing the site in or display accommodations such as text size and contrast ratio.
        </p>

        <p>
          Tracking We use cookies to identify you when you visit multiple pages on our site. This is important to understand how you navigate between pages and content. This information is used to improve your experience and in an anonymous form when published as research.
        </p>

        <p>
          Research This service is provided by Open Lab, Newcastle University and is part of a research project. The data we collect from users when they use the service is likely to be analysed and published. We keep individual user data anonymous and respect user privacy. You can read more about how your data is used in research in our Research Policy.
        </p>

        <h2>Do we use other cookies?</h2>
        <p>
          We use Google Analytics to track how people use our site. Google use cookies to track usage, we encourage you to review their privacy policy and terms if you accept the use of cookies on this site.
        </p>

        <h2>How to control cookies</h2>
        <p>
          You can control and/or delete cookies as you wish – for details, see aboutcookies.org. You can delete all cookies that are already on your computer and you can set most browsers to prevent them from being placed. If you do this, however, you may have to manually adjust some preferences every time you visit a site and some services and functionalities may not work.
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
