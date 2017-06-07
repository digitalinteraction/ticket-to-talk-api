<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">
    <!--Import materialize.css-->
    <link media="screen,projection" type="text/css" rel="stylesheet" href="/css/materialize.css">
    <link media="all" type="text/css" rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Ticket to Talk</title>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: an application helping to scaffold interactions between younger people and older relatives with dementia.">
</head>

<body>

    <div id="title-block" class="row">

        <div class="container">
    		<div id="title-bar" class="row">
    			<h1 class="col s12 center-align">Ticket to Talk</h1>
    			<h3 class="col s12 center-align">Bridge the Generational Gap</h3>
    		</div>
    	</div>


        <div class="container">
            <div id="title-description" class="card-panel center-align row">
                <p>
                    An application helping to support conversation between younger people and older relatives with dementia.
                    <br/>
                    Use Ticket to Talk to create talking points with older relatives through crafting a collection of pictures, sounds, and YouTube videos.
                </p>
            </div>
        </div>

    </div>

    <!-- <div id="sign-up" class="row" style="display:none"> -->
    <div id="sign-up" class="row">

        <div class="container">
            <p>
                Please enter an email address below if you would like to receive updates on Ticket to Talk or are interested in opportunities to take part in future research projects on intergenerational communication within dementia.
            </p>
            <div class="col s8 offset-s2 left-align">
                <div class="input-field col s8">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s4">
                    <button class="btn waves-effect waves-light" id="subscribe">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="info" class="row">
        <div id="about" class="info-box row">
            <h3 class="info-box-header col l2 offset-l1 s12">About</h3>
            <div class="col l8 m12 info-box-text">
                <p>
                    Ticket to Talk is a smartphone application that aims to help encourage conversation between younger people and grandparents, friends or people they care for who are experiencing dementia. The app is designed to help collect and curate digital media (”tickets”) to be used to prompt and stimulate talk, conversation and reminiscence between younger people and those they are close to with dementia.
                </p>
                <p>
                    Upon opening the app for the first time, you are asked to create a profile about you and a profile about the person with whom you’d like to talk with. You can also add other family members, close friends, or caregivers to the app so they can have access to, or contribute, content to peoples profiles. After this the app guides you to add bits of media - we call these “Tickets”. Tickets are things that can be used as prompts in conversations. Tickets are created in-app by selecting photos from the phone’s library, taking new photos or videos with the camera, or by using the microphone to record songs and sounds.
                </p>
                <p>
                    If you are struggling to come up with ideas for Tickets the app gives some small bits of inspiration to respond to, e.g. “Can you find a picture of Sarah’s old car?”. This helps you to build up a collection quickly. To use the tickets as prompts you are encouraged by the app to curate these into a “Conversation”. This is essentially a playlist of Tickets to be used as a shared resource in conversation. During an in-person conversation with a loved one or the person you care for, you would press play and the tickets would be presented to cycle through. At the end of the conversation the app will prompt you to make some short notes on how the conversation went. This can be useful to keep track of conversation topics that they went particularly well, and use these to develop new Tickets for future visits.
                </p>
            </div>
        </div>

        <div id="origin" class="info-box row">
            <h3 class="info-box-header col l2 offset-l1 s12">Origin</h3>
            <div class="col l8 m12 info-box-text">
                <p>
                    The app has been developed as part of the DemYouth project, where we have been working with groups of young people with personal experiences of dementia. The DemYouth project has been supported through grants from the ESRC, EPSRC and Newcastle University’s Institute for Social Renewal. It is an ongoing collaboration between researchers at Newcastle and Northumbria Universities and partners at the Alzheimer’s Society and Youth Focus North East as part of the larger DemTalk project (www.demtalk.org.uk). The Ticket-to-Talk project has been contributed to by: Tony Young (Newcastle University), Daniel Welsh (Newcastle University), John Vines (Northumbria University), Roisin McNaney (Lancaster University), Kellie Morrissey (Newcastle University), Tom Schofield (Newcastle University), Leon Mexter (Youth Focus North East) and Jamie Mercer (Youth Focus North East).
                </p>
            </div>
        </div>

        <div id="when" class="info-box row">
            <h3 class="info-box-header col l2 offset-l1 s12">Availability</h3>
            <div class="col l8 m12 info-box-text">
                <div id="when-text" class="center-align">
                    <div id="store-icons">
                        <div class="col s6">
                            <a class="row store-link" href="https://itunes.apple.com/us/app/ticket-to-talk/id1203783044?ls=1&mt=8"><i class="fa fa-apple" aria-hidden="true"></i></a>
                            <h5 class="row">Available Now</h5>
                        </div>
                        <div class="col s6">
                            <a class="row store-link"><i class="fa fa-android" aria-hidden="true"></i></a>
                            <h5 class="row">Coming Soon!</h5>
                        </div>
                    </div>
                </div>
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
