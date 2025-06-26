<!DOCTYPE html>
<html>
<head>
  <style>
    .box {
      width: 100px;
      height: 100px;
      background-color: orange;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      border-radius: 10px;
      animation: scroll-left 3s infinite alternate;
    }

    @keyframes scroll-left{
      0% {
        transform: translateY(0%);
      }
      100% {
        transform: translateY(100vh);
      }
    }
  </style>
</head>
<body>
  <div class="box">Horizontal</div>
</body>
</html>