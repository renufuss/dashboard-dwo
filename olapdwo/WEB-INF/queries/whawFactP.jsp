<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost/whaw?user=root&password=" catalogUri="/WEB-INF/queries/whawFactProduction.xml">

select {[measures].[total Quantity]} ON COLUMNS, 
    {([Time],[Product])} ON ROWS 
from [Production]

</jp:mondrianQuery>

<c:set var="title01" scope="session">Query WH Adventure Fact Production using Mondrian OLAP</c:set>
