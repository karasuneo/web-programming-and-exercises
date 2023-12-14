
<body class="container">
  <header>
    <h1 class="display-4">
      <%= title %></h1>
  </header>
  <div role="main">
    <table class="table">
      <% for(var i in content) { %>
      <tr>
        <% var obj = content[i]; %>
        <th><%= obj.id %></th>
        <td><%= obj.name %></td>
        <td><%= obj.mail %></td>
        <td><%= obj.age %></td>
      </tr>
      <% } %>
    </table>
  </div>
</body>





