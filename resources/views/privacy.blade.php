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

    <title>Ticket to Talk | Privacy</title>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: Privacy Policy">
</head>

<body>

  <section class="hero is-medium">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Ticket to Talk | Privacy Policy</h1>

        <div class="content">
          <h2 class="subtitle">Key Points</h2>

          <p>
            Your privacy is important to us and we believe you should always know what data we collect from you and the ways in which we use it. Our aim is to give you meaningful control and empower you to make the best decisions about the information you share with us.
          </p>
          <p>
            <strong>Here are some key points from the policy, but please read the full document:</strong>
          </p>
          <p>
            Ticket to Talk is a public service and anything you post is available instantly to anyone around the world.
            Ticket to Talk has been developed at Open Lab, Newcastle University as a research project. Any information we collect from you will be stored securely in the EU and may be subject to processing. We often publish findings based on user activity, these publications will never contain information or data that could be used to identify you as an individual.
          </p>
          <p>
            When you use Ticket to Talk, even if you are just browsing through the content, we receive some personal information about you like your IP address and the type of device you are using. When you sign up you may be asked for additional information such as your email address, name and a public profile which we use to keep your account secure and improve the experience for yourself and other users.
            If you have any questions about this policy, how we collect or process your personal data or anything else related to our privacy practices, you can contact us at any time.
          </p>
          <p>
            Ticket to Talk may share personal data with businesses outside of the EU in order to provide a better service. Ticket to Talk is hosted on Newcastle University servers, uses Amazon S3 for storing data securely and Newcastle University emails to distribute emails.
            Ticket to Talk complies with GDPR and any external services that are not based in the EU comply with the EU-US Privacy Shield Frameworks as set forth by the U.S. Department of Commerce regarding the collection, use, and retention of personal data from the EU and Switzerland. For more information about the Privacy Shield generally, and to view the certificates online, please visit https://www.privacyshield.gov.
          </p>
        </div>

      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="content">
        <h1 class="is-size-2">Full Privacy Policy</h1>
        <p>
          Please read this privacy policy carefully before using the services offered by Open Lab, University of Newcastle Upon Tyne (“Open Lab, Newcastle University”, "Open Lab, University of Newcastle Upon Tyne", “we”, “us”). We recognise the importance of your privacy. Therefore, we have created this Privacy Policy so that you know how we use and disclose your information when you make it available to us. This Privacy Policy applies solely to information collected at this Site. By using or accessing the Site, you signify your agreement to be bound by our Privacy Policy.
        </p>
        <p>
          <strong>IF YOU DO NOT AGREE TO THIS PRIVACY POLICY YOU MAY NOT ACCESS OR OTHERWISE USE OUR SITE.</strong>
        </p>

        <h2>Non-personal or Aggregate Information that we collect:</h2>
        <p>
          We may collect non-personally identifiable information, such as pages viewed, browser type, duration and frequency of visits or other data, and may aggregate any information collected in a manner which does not identify any individual (“Aggregate Information”). Aggregate Information obtained in connection with the Site may be intermingled with and used by us in conjunction with information obtained through sources other than the Site, including both offline and online sources. Aggregate Information may be shared by us with third parties by allowing them to link to and collect data from the Site. This data will be used for their benefit and for ours, for marketing advertising or other purposes, including analysis of the Site for purposes of improving your experience with the Site and academic publication.
        </p>

        <h2>Clickstream:</h2>
        <p>
          As you use the Internet, a trail of electronic information is left at each website you visit. This information, which is sometimes referred to as “clickstream data,” can be collected and stored by a website’s server. Clickstream data can tell us the type of computer and browsing software you use and the address of the website from which you linked to the Site. We may collect and use clickstream data as a form of Aggregate Information to anonymously determine how much time visitors spend on each page of our Site, how visitors navigate throughout the Site and how we may tailor our web pages to better meet the needs of visitors. This information will be used to improve our Site and our services. Any collection or use of clickstream data will be anonymous and aggregated, and will not intentionally contain any personal information. We may also use this aggregated data in order to conduct academic research studies. As a result of these academic research studies we may publish the anonymous aggregated data we have outlined.
        </p>

        <h2>Information Usage:</h2>
        <p>
          We will only use your personal information as described below, unless you have specifically consented to another type of use, either at the time the personal information is collected from you or through some other form of consent from you or notification to you. We may use your personal information as follows: (i) to respond to your inquires or requests; (ii) to send you emails and newsletters from time to time with information about our Site; (iii) to share with our partners, by allowing them to link to and collect your information from the Site; (iv) we may permit our vendors and subcontractors to access your personal information, but they are only permitted to do so in connection with performing services for us; (v) we may disclose personal information as required by law or legal process; (vi) to investigate suspected fraud, harassment or other violations of any law, rule or regulation, or the terms or policies for our services or our sponsors and (vii) we may transfer your personal information in connection with the sale or merger or change of control of the services.
        </p>

        <h2>Cookies:</h2>
        <p>
          Our Site may pass a “cookie” (a string of information that is sent by a website to reside on your system’s hard drive and/or temporarily in your computer's memory blocks) or similar items, such as web beacons, gifs, and tags. The purpose of a cookie is to tell the web server that you have returned to a particular page. You may set your browser to decline cookies. If you do so, however, you may not be able to fully experience some features of the Site. Additionally, we may include small graphic images in our email messages and newsletters to you in order to determine whether these messages were opened and whether any links contained in these messages were viewed.
        </p>

        <h2>Security:</h2>
        <p>
          We will ensure that we put in place and will maintain appropriate technical and organisational measures to safeguard any personal information submitted onto the Site. However, you acknowledge that due to the inherent open nature of the Internet, no transmission via the Internet can be guaranteed to be 100% secure. As a result of this and other factors beyond our control, we cannot guarantee the security of the information that you transmit to or through our Site. Therefore, you assume that risk by using the Site.
        </p>

        <h2>Your Disclosure on the Site and in Social Media:</h2>
        <p>
          You should be aware that any information that you submit to any portion of the Site that is viewable by the public, such a publicly accessible blog, chat room, social media platform or otherwise online may be viewed and used by others without any restrictions. We are unable to control such uses of your personal information, and by using such services you assume the risk that the personal information provided by you may be viewed and used by third parties for any number of purposes.
        </p>

        <h2>Protection for Children:</h2>
        <p>
          We do not collect personal information from children under the age of 13 years old. When we become aware that personal information from a child under 13 years old has been collected without such child’s parent or guardian’s consent, we will use all reasonable efforts to delete such information from our database. We encourage parents to monitor the online activities of their children to ensure that no information is collected from a child without parental permission.
        </p>

        <h2>Other Sites and Applications:</h2>
        <p>
          As a convenience to you, we may provide links to third-party sites from within our Site. We are not responsible for the privacy practices or content of any third parties or third-party sites. We encourage you to review these privacy policies to ensure that you are familiar with their terms.
        </p>
        <p>
          If you use any extra plug-ins or third party applications (“Applications”) in connection with the Site, the provider(s) of these Applications may obtain access to certain personal information about you. We do not and cannot control how the providers of Applications may use any personal information collected in connected with such Applications. Please be sure to review any privacy policies or other terms applicable to your use of these Applications prior to installation.
        </p>

        <h2>Changes to this Privacy Policy:</h2>
        <p>
          We reserve the right, at our discretion, to change, modify, add, or remove portions from this Privacy Policy at any time. Your continued use of the Site following the posting of any changes to this Privacy Policy means you accept and consent to such changes.
        </p>

        <h2>Opt-Out Process:</h2>
        <p>
          If you do not want to receive email communications (including email digests) from us in the future, please send an email to us at openlab-admin@newcastle.ac.uk requesting to be removed from our mailing list. You will also have the option of clicking on a link included in email correspondence you receive from us in order to remove yourself from our mailing list.
        </p>
        <p>
          If you do not want to want to receive our newsletters in the future, please send an email to us at openlab-admin@newcastle.ac.uk requesting to be removed from our mailing list. You will also have the option of clicking on a link included in the newsletters you receive from us in order to remove yourself from our mailing list.
        </p>
        <p>
          We are not, however, responsible for removing your personal information from the lists of any third party who has previously been provided your information in accordance with this Privacy Policy or your consent, such as a sponsor. You should contact such third parties directly if you wish to have your personal information removed from their lists.
        </p>

        <h2>Communications with Us:</h2>
        <p>
          By providing your email address to us, you expressly consent to receive emails from us. We may use email to communicate with you, to send information that you have requested or to send information about other products or services developed or provided by us or our business partners, provided that, we will not give your email address to another party to promote their products or services directly to you without your consent or as set forth in this policy.
        </p>
        <p>
          Any communication or material you transmit to us by email or otherwise, including any data, questions, comments, suggestions, or the like is, and will be treated as, nonconfidential and nonproprietary. Furthermore, you expressly agree that we are free to use any ideas, concepts, know-how, or techniques contained in any communication you send to us without compensation and for any purpose whatsoever, including but not limited to, developing, manufacturing and marketing products and services using such information.
        </p>

        <h2>Site Terms of Use:</h2>
        <p>
          Use of this Site is governed by, and subject to, the Terms of Use contained <a href="/terms">here</a>. This Privacy Policy is incorporated into such terms. Your use, or access, of the Site constitutes your agreement to be bound by these provisions.
        </p>

        <p>
          <strong>IF YOU DO NOT AGREE TO THESE TERMS OF USE YOU MAY NOT ACCESS OR OTHERWISE USE THE SITE.</strong>
        </p>

        <p>
          Transfers of Personal Data Outside the EEA: The personal data that we collect from you may be transferred to, and stored at, a destination outside the European Economic Area ("EEA"). It may also be processed by staff operating outside the EEA who work for us or for one of our suppliers. By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy.
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
