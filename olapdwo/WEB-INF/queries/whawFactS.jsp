
<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost/whaw?user=root&password=" catalogUri="/WEB-INF/queries/whawFactSales.xml">

select {[Measures].[Order Quantity],[Measures].[Unit Price],[Measures].[Line Total]} ON COLUMNS,
  {([Time],[Address Location],[sales Person],[Product])} ON ROWS
from [Sales]


</jp:mondrianQuery>





<c:set var="title01" scope="session">Query WH Adventure  Fact Sales using Mondrian OLAP</c:set>
