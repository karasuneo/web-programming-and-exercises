
<body class="container">
  <header>
    <h1 class="display-4">
      <%= title %></h1>
  </header>
  <div role="main">
    <p><%- content %></p>
    <form method="post" action="/hello/add">
      <div class="form-group">
        <label for="name">NAME</label>
        <input type="text" name="name" id="name" 
          value="<%= form.name %>" 
          class="form-control">
      </div>
      <div class="form-group">
        <label for="mail">MAIL</label>
        <td><input type="text" name="mail" id="mail" 
            value="<%= form.mail %>" 
            class="form-control">
      </div>
      <div class="form-group">
        <label for="age">AGE</label>
        <td><input type="text" name="age" id="age" 
          value="<%= form.age %>" 
          class="form-control">
      </div>
      <input type="submit" value="作成" 
        class="btn btn-primary">
    </form>
  </div>
</body>





