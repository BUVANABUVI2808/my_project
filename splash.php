<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Premium Bookings</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: black;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
    }

    /* Logo */
    .logo {
      width: 180px;
      opacity: 0;
      transform: scale(0.5);
      animation: logoAnimation 3s ease forwards;
      filter: drop-shadow(0 0 20px gold) drop-shadow(0 0 40px #ffcc00);
    }

    @keyframes logoAnimation {
      0% {
        opacity: 0;
        transform: scale(0.5);
      }

      50% {
        opacity: 1;
        transform: scale(1.3);
      }

      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* Texts */
    h2,
    h4 {
      opacity: 0;
      margin: 10px 0 0 0;
      letter-spacing: 2px;
    }

    h2 {
      font-family: popins;
      font-size: 28px;
      color: gold;
      animation: textFade 2s ease forwards;
      animation-delay: 2s;
      /* logo ku apram */
    }

    h4 {
      font-size: 18px;
      font-family: popins;
      color: #ccc;
      font-weight: normal;
      animation: textFade 2s ease forwards;
      animation-delay: 2.5s;
      /* premium bookings ku apram */
    }

    @keyframes textFade {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

  <script>
    // 4.5s ku apram homepage redirect
    setTimeout(() => {
      window.location.href = "index.php";
    }, 4500);
  </script>
</head>

<body>
  <img src="posters/logo.png" alt="Logo" class="logo">
  <h2>Premium Bookings</h2>
  <h4>Enjoy weekends with your family...</h4>
</body>

</html>