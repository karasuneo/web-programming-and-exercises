
<% if (val != null){ %>
  <tr class="row">
    <th class="col-2">
      <a class="text-dark" href="/boards/home/<%=val.account.name %>/<%=val.accountId %>/0">
        <%= val.account.name %></a></th>
    <td class="col-7"><%= val.message %></td>
    <%
      var d = new Date(val.createdAt);
      var dstr = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + 
        d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + 
        ':' + d.getSeconds();
    %>
    <td class="col-3"><%= dstr %></td>
  </tr>
<% } %>





