
<body class="container">
  <header>
    <h1>
      <%= title %></h1>
  </header>
  <div role="main">
    <p class="h6"><%- content %></p>
    <form method="post" action="/hello/post">
      <div class="form-group">
        <label for="msg">Message:</label>
        <input type="text" name="message" id="msg" 
          class="form-control">
      </div>
      <input type="submit" value="送信" 
        class="btn btn-primary">
    </form>
  </div>
</body>





