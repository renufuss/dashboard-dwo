/*README*/
Tutorial menjalankan dashboard DWO
<ol>
<li>Install XAMPP, Composer, dan GitBash</li>
<li>masuk ke folder XAMPP/htdocs</li>
<li>click-kanan pada folder pilih opsi git bash here</li>
<li>ketik "git clone https://github.com/renufuss/dashboard-dwo" tekan enter</li>
<li>masuk ke folder dashboard-dwo di htdocs</li>
<li>copy file olapdwo</li>
<li>masuk ke xampp/tomcat/webapps</li>
<li>paste file olapdwo ke xampp/tomcat/webapps</li>
<li>Hidupkan Database MySQL & Apache melalui XAMPP</li>
<li>Kemudian database baru dengan nama whaw di http://localhost/phpmyadmin</li>
<li>Import database whaw.sql</li>
<li>Run Tomcat di XAMPP</li>
<li>click-kanan pada folder /XAMPP/htdocs/dashboard-dwo/ pilih opsi git bash here</li>
<li>ketik "php spark serve --port 8083"</li>
<li>Buka Website "http://localhost:8083"</li>
<li>Selesai!</li>
</ol>

#Pastikan config xampp (intl) diaktifkan# <br>
#JIKA TERJADI ERROR PADA JDBC COPY FILE "mysql-connector-j-8.0.31.jar" DARI FOLDER OLAP DWO KE FOLDER xampp/tomcat/lib#
