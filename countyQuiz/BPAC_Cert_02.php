<!doctype html>
<html lang="en">
<!--
   Author Name: W.Woods
   Assignment : BPAC Certificate
   Due Date   : 03/21/2017
-->




   <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Certificate for Printing</title>
     <link rel="stylesheet" href="certificate.css">
   </head>
   <body>
     <!-- <h1 class="no-print">Certificate Rendering</h1> -->
     <!-- <p class="no-print">Since this is going to be printed, I'm going to force fixed dimensions according to a landscape document.</p> -->

     <div class="certificate">
       <p class="name"><strong><?php echo $_POST["name"];  ?></strong></p>
       <p class="date"><strong><?php echo $_POST["date"];  ?></strong></p>
     </div>

   </body>
   </html>
