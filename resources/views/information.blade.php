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
    <!--Import materialize.css-->
    <link media="screen,projection" type="text/css" rel="stylesheet" href="/css/materialize.css">
    <link media="all" type="text/css" rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Ticket to Talk | Information</title>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: Privacy Policy">
</head>

<body>

<div id="title-block" class="row">

    <div class="container">
        <div id="title-bar" class="row">
            <h1 class="col s12 center-align">Ticket to Talk</h1>
            <h3 class="col s12 center-align">Information on Taking Part</h3>
        </div>
    </div>

    <div class="container">
        <div id="title-description" class="card-panel center-align row">
            <p>
                Open Lab at Newcastle University is conducting research into how technology can be used to support conversations between younger people and people living with dementia. This study will explore experiences of this interaction by using the Ticket to Talk application and other activities, and then use these experiences to understand how to create further supportive technologies.
            </p>
        </div>
    </div>

</div>

<div id="info" class="row">

    <div id="about" class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Who We Are Looking For</h3>
        <div class="col l8 m12 info-box-text">
            <br />
            <p>
                We are looking for younger people who have a friend or relative living with dementia.
                <br/>
                <strong>
                    We are explicitly looking for people who are 18 or older.
                </strong>
            </p>
        </div>
    </div>

    <div id="about" class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Why We Need Your Help</h3>
        <div class="col l8 m12 info-box-text">
            <br />
            <p>
                Younger relatives of people with dementia often face difficulties in conversation, with one of the biggest barriers in conversation being a lack of mutual topics of interest. With your use of Ticket to Talk you can help us gain a better understanding of families’ experiences with intergenerational interaction and how we can help support it. With our new understanding on how families like yourselves manage this interaction we can create better supportive technologies to promote more positive conversations and relationships within families.
            </p>
        </div>
    </div>

    <div class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Your Involvement</h3>
        <div class="col l8 m12 info-box-text">
            <p>
                You can participate by using Ticket to Talk to collect photos, sounds, and YouTube videos and use these as prompts in conversation. If you agree to take part then we would use the data you collect to understand how different types of media are used to support conversation. We would do this by observing what types of media you are creating, along with how long you use different types of Tickets in conversation.
            </p>
        </div>
    </div>

    <div class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Confidentiality</h3>
        <div class="col l8 m12 info-box-text">
            <p>
                All collected data will be confidential and will be stored securely. We will only use the type of media you create and do not have access to the photos, videos, and audio files you have created. Your data will be archived at Newcastle University and will be made accessible to other researchers; during this process you will remain anonymous. We will perform an analysis on how you use the application however this will also be anonymous, such as how long you use Ticket to Talk in conversation and what kind of media you find useful. This information will only be used for a report of the project and potential publications, of which you will remain anonymous in.
            </p>
        </div>
    </div>

    <div class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Withdrawing from the Study</h3>
        <div class="col l8 m12 info-box-text">
            <p>
                You can withdraw at any point without penalty. If you no longer wish to take please contact a researcher, at which point all information we have collected about you will be destroyed.
            </p>
        </div>
    </div>

    <div class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">What Happens Next?</h3>
        <div class="col l8 m12 info-box-text">
            <p>
                If you are interested in taking part then please select the option to take part in the Ticket to Talk study when registering to use the service. If you have any further questions before taking part in the study then please contact Daniel Welsh via the below email address
                below.
            </p>
            <p>
                Daniel Welsh
                <br/>
                <a href="mailto:d.welsh@ncl.ac.uk">d.welsh&#64;ncl.ac.uk</a>
            </p>

            <p>
                Kellie Morrissey
                <br/>
                <a href="mailto:kellie.morrissey@ncl.ac.uk">kellie.morrissey&#64;ncl.ac.uk</a>
            </p>
        </div>
    </div>

    <div class="info-box row">
        <h3 class="info-box-header col l2 offset-l1 s12">Effective Date</h3>
        <div class="col l8 m12 info-box-text">
            <p>
                This information was last updated on the 6th of June 2017.
            </p>
        </div>
    </div>
</div>

<footer class="page-footer">
    <div class="container valign-wrapper">
        <div id="logos" class="row valign">
            <img src="/images/NewcastleUni_white.png" class="col s2 responsive-img" alt="Newcastle University"/>
            <img src="/images/ESRC_white.png" class="col s2 responsive-img" alt="ESRC"/>
            <img src="/images/EPSRC_white.png" class="col s2 responsive-img" alt="EPSRC"/>
            <img src="/images/NewcastleUniNISR_white.png" class="col s2 responsive-img" alt="Newcastle University ISR"/>
            <img src="/images/DigitalEconomy_white.png" class="col s2 responsive-img" alt="Digital Economy"/>
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
</footer>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="/js/materialize.js"></script>
<script src="/js/script.js"></script>

</body>
</html>
