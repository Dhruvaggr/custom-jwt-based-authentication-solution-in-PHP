# Custom-jwt-based-authentication-solution-in-PHP

PROJECT FLOW 

Step 1.  Imported CSV file to DB in PHP
Step 2.  POST method to retrive the data of the json request which is sent from the body header -> raw in POSTMAN. (Image is attached.) and secret key is passed from 
         the authorization header.
Step 3.  Authorized with api key.
Step 4.  After authorization,create JSON WEB TOKEN(JWTs) using HEADERS.PAYLOAD.SIGNATURE.(base64URL_encoded). Algorithm used in signature is SHA256. 
Step 5.  Query is run on the basis of the request sent from the POSTMAN which fetched the corresponding data from the database which is encrypted in JWT's.
Step 6.  The JWT is created and sent to client.The client stores these jwt in local storage and can use to send the request to server toget the data encrypted in jwt.
Step 7. 
