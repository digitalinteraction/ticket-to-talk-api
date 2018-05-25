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
  <link media="all" type="text/css" rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
  <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Ticket to Talk</title>
  <meta author="Daniel Welsh"/>
  <meta charset="UTF-8">
  <meta name="description" content="Ticket to Talk: supporting interactions between younger people and older relatives with dementia.">
</head>

<body>
  <section class="hero is-medium">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Ticket to Talk</h1>
        <h2 class="subtitle">Bridge the Generational Gap</h2>
        <p>
            Ticket to Talk hopes to encourage conversation between younger people and grandparents, friends or people they care for who are experiencing dementia. The app is designed to help collect and curate digital media (”tickets”) to be used to prompt and stimulate talk, conversation and reminiscence between younger people and those they are close to with dementia.
        </p>
        <div id="store-icons" class="">
          <a class="store-link" href="https://itunes.apple.com/us/app/ticket-to-talk/id1203783044?ls=1&mt=8" style="display: block; z-index: 1;">
            <object class="store-icon" type="image/svg+xml" data="/images/app_store.svg" style="z-index: -1; pointer-events: none;">
                Your browser does not support SVG
            </object>
          </a>
          <a class="store-link" href="https://play.google.com/store/apps/details?id=uk.ac.ncl.openlab.tickettotalk&hl=en_GB&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="display: block; z-index: 1;">
            <object class="store-icon" type="image/svg+xml" data="/images/google_play.svg" style="z-index: -1; pointer-events: none;">
              Your browser does not support SVG
            </object>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="screenshots" class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-one-third">
          <img src="/images/screenshots/01.png" class="is-one-quarter">
        </div>
        <div class="column is-one-third">
          <img src="/images/screenshots/02.png" class="is-one-quarter">
        </div>
        <div class="column is-one-third">
          <img src="/images/screenshots/03.png" class="is-one-quarter">
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="feature-desc">
    <div class="container">
      <div class="columns">

        <div class="column is-one-third">
          <p class="emoji">👵</p>
          <p>
            Use Ticket to Talk to create a profile for an older relative or friend, and record some useful information about them
          </p>
        </div>

        <div class="column is-one-third">
          <p class="emoji">💡</p>
          <p>
            Use the Inspirations to get ideas about what you and your friend can talk about together
          </p>
        </div>

        <div class="column is-one-third">
          <p class="emoji">🎥</p>
          <p>
            Record pictures, sounds, or videos, you want to share and save as tickets in the app
          </p>
        </div>
      </div>
      <div class="columns">
        <div class="column is-one-third">
          <p class="emoji">🎟</p>
          <p>
            Collect your tickets into conversations, where you can prepare what you want to talk about before a visit
          </p>
        </div>

        <div class="column is-one-third">
          <p class="emoji">🌁</p>
          <p>
            Show your older relative or friend your tickets as a conversation starter if you reach a gap in the conversation
          </p>
        </div>

        <div class="column is-one-third">
          <p class="emoji">👨‍👩‍👧‍👦</p>
          <p>
            Share your tickets and conversations with other family members and friends to help them talk to your older relative
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="section">
    <div class="container">
      <div>
        <h1 class="title is-3">About</h1>
        <p>
            Ticket to Talk is a smartphone application that aims to help encourage conversation between younger people and grandparents, friends or people they care for who are experiencing dementia. The app is designed to help collect and curate digital media (”tickets”) to be used to prompt and stimulate talk, conversation and reminiscence between younger people and those they are close to with dementia.
        </p>
        <br/>
        <p>
            Upon opening the app for the first time, you are asked to create a profile about you and a profile about the person with whom you’d like to talk with. You can also add other family members, close friends, or caregivers to the app so they can have access to, or contribute, content to peoples profiles. After this the app guides you to add bits of media - we call these “Tickets”. Tickets are things that can be used as prompts in conversations. Tickets are created in-app by selecting photos from the phone’s library, taking new photos or videos with the camera, or by using the microphone to record songs and sounds.
        </p>
        </br/>
        <p>
            If you are struggling to come up with ideas for Tickets the app gives some small bits of inspiration to respond to, e.g. “Can you find a picture of Sarah’s old car?”. This helps you to build up a collection quickly. To use the tickets as prompts you are encouraged by the app to curate these into a “Conversation”. This is essentially a playlist of Tickets to be used as a shared resource in conversation. During an in-person conversation with a loved one or the person you care for, you would press play and the tickets would be presented to cycle through. At the end of the conversation the app will prompt you to make some short notes on how the conversation went. This can be useful to keep track of conversation topics that they went particularly well, and use these to develop new Tickets for future visits.
        </p>
      </div>
      <div>
        <h1 class="title is-3">Origin</h1>
        <p>
            The app has been developed as part of the DemYouth project, where we have been working with groups of young people with personal experiences of dementia. The DemYouth project has been supported through grants from the ESRC, EPSRC and Newcastle University’s Institute for Social Renewal. It is an ongoing collaboration between researchers at Newcastle and Northumbria Universities and partners at the Alzheimer’s Society and Youth Focus North East as part of the larger DemTalk project (www.demtalk.org.uk). The Ticket-to-Talk project has been contributed to by: Daniel Welsh (Newcastle University), John Vines (Northumbria University), Roisin McNaney (Lancaster University), Kellie Morrissey (Newcastle University), Tom , Leon Mexter (Youth Focus North East), Jamie Mercer (Youth Focus North East), and Tony Young (Newcastle University).
        </p>
      </div>
      <div>
        <h1 class="title is-3">Availability</h1>
        <div id="store-icons" class="">
          <a class="store-link" href="https://itunes.apple.com/us/app/ticket-to-talk/id1203783044?ls=1&mt=8" style="display: block; z-index: 1;">
            <object class="store-icon" type="image/svg+xml" data="/images/app_store.svg" style="z-index: -1; pointer-events: none;">
                Your browser does not support SVG
            </object>
          </a>
          <a class="store-link" href="https://play.google.com/store/apps/details?id=uk.ac.ncl.openlab.tickettotalk&hl=en_GB&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" style="display: block; z-index: 1;">
            <object class="store-icon" type="image/svg+xml" data="/images/google_play.svg" style="z-index: -1; pointer-events: none;">
              Your browser does not support SVG
            </object>
          </a>
        </div>
      </div>
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
        <a class="col s2" href="/privacy">
          Privacy
        </a>
        |
        <a class="col s2" href="/terms">
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
