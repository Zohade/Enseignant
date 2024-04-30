<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="{{asset('assets/css/forgot.css')}}">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Validation par e-mail</title>
</head>
<body>
      <form class="form1" action="{{route('newPass')}}" method="post">
        @csrf
          <div class="title">OPT</div>
          <div class="title">Code de vérification</div>
          <p class="message">Nous vous avons envoyé un code sur votre adresse mail. <em>Si vous ne l'avez pas rétrouvé, vérifier vos spams.
                            Sinon, vous pouvez demander qu'on vous le renvoies à nouveau</em>
          </p>
         <div class="inputs">
             <input id="input1" type="text" maxlength="1">
             <input id="input2" type="text" maxlength="1">
             <input id="input3" type="text" maxlength="1">
             <input id="input4" type="text" maxlength="1">
             <input id="input5" type="text" maxlength="1">
         </div>
         <section class="timer">
            <div id="timer"></div>
            <button id="resendButton" class="renvoyer">Renvoyer</button>
         </section>
         <button class="action">Vérifiez</button>
      </form>

      <script>
            // Durée en secondes avant de pouvoir renvoyer le code OPT à nouveau
            const resendDelay = 60;

            let timerInterval;
            let remainingTime = resendDelay;

            const timerElement = document.getElementById('timer');
            const resendButton = document.getElementById('resendButton');

            function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
            }

            function updateTimer() {
            if (remainingTime > 0) {
                remainingTime--;
                timerElement.innerText = `Demandez le code dans ${remainingTime}s`;
            } else {
                clearInterval(timerInterval);
                resendButton.disabled = false;
                timerElement.innerText = '';
            }
            }

            function resendOTP() {
            // Logique pour renvoyer le code OTP, par exemple :
            // Ici vous pouvez ajouter votre logique d'envoi de code OPT par email ou SMS
            console.log('Code OTP renvoyé !');

            remainingTime = resendDelay;
            resendButton.disabled = true;
            startTimer();
            }

            // Initialiser le timer
            startTimer();

            // Attacher un gestionnaire d'événements au bouton de renvoi
            resendButton.addEventListener('click', resendOTP);
</script>
</body>
</html>
