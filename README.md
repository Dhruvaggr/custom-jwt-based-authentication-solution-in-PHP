# Custom-jwt-based-authentication-solution-in-PHP

<h3>PROJECT FLOW</h3>

Step 1.  Imported CSV file to DB in PHP. <strong>[index.php , csv_import.php]</strong><br><br>
Step 2.  POST method to retrive the data of the json request which is sent from the body header -> raw in POSTMAN. (Image is attached.) and secret key is passed from 
         the authorization header.<strong>[apijwt.php]</strong><br>
Step 3.  Authorized with api key. <strong>[readapi.php]</strong> <br>
Step 4.  After authorization,create JSON WEB TOKEN(JWTs) using HEADERS.PAYLOAD.SIGNATURE.(base64URL_encoded). Algorithm used in signature is SHA256.
         <strong> [readapi.php]</strong> <br><br>
Step 5.  Query is run on the basis of the request sent from the POSTMAN which fetched the corresponding data from the database which is encrypted in JWT's.
         <strong>[data.php]</strong> <br><br>
Step 6.  The JWT is created and sent to client.The client stores these jwt in local storage and can use to send the request to server toget the data encrypted in jwt.
         <strong>[data.php]</strong> <br><br>
Step 7. To check the data encrypted in JWT another API is created. In this API in POSTMAN authorization header (in Bearer Token) that JWT is passed and this sends 
        the request to server. <strong>[jwtcheck.php]</strong><br><br>
Step 8. The server gets the JWT, and checks whether this JWT is that only which was created at the time of JWT generation.<strong>[jwtcheck.php]</strong> <br><br>
Step 9. After succesful authorization and validation of JWT, data is decoded from token in the server and sends back to client. <strong>[jwtcheck.php]</strong>
