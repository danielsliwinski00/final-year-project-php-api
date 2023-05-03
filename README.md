This repo is for the API for the project and it includes instructions for use

The other repos:  
Ordering system: https://github.com/danielsliwinski00/final-year-project-react-native  
Employee system: https://github.com/danielsliwinski00/final-year-project-employee-app  

This Project requires XAMPP to be used:  
https://www.apachefriends.org/download.html  
Run xampp-control.exe,  
Now in the XAMPP Control Panel start Apache and mySQL,  
On a browser navigate to localhost:(port if needed)/phpmyadmin,  
in my case this is http://localhost:8080/phpmyadmin/  

Here you will need to create a database called restaurant,  
in the restaurant database you will need to make 2 tables, first called 'menu', the other called 'orders',  

in the menu table you will need 8 columns:  
id - int  
dish - text  
description - longtext  
price - double  
quantity - int  
special - tinyint  
available - tinyint  
type - int  

in the orders table you will need 4 columns:  
orderid - int  
dish - longtext  
tablenumber - int  
time - datetime  

you will need to import a csv of your menu into the menu table,    
here is an example file you can download as a csv:    
https://drive.google.com/file/d/1WJnDqMD_IkGQDY6Z1esgs7M3FGGaxN7I/view?usp=sharing    
**REMEMBER TO SKIP THE FIRST QUERY**  

The API files need to git cloned into htdocs (XAMPP) via  

(Project requires **ALL** fetch requests to be changed to localhost or equivalent (with port if needed) e.g. 192.168.1.102:8080  
```
return fetch("http://192.168.1.102:8080/api/sendorder.php",
```

Next you need to clone the 2 interaction repos (in separate terminals, can be cloned to almost anywhere)  
```
git clone https://github.com/danielsliwinski00/final-year-project-react-native
------------------------------------------------------------------------------
git clone https://github.com/danielsliwinski00/final-year-project-employee-app
```

Then after navigating to both (in separate terminals) via  
```
cd final-year-project-react-native
----------------------------------
cd final-year-project-employee-app
```

You want to npm install both (to get the project dependancies)  
```
npm install
```

After that you should be good to run both in webview (they will need separate ports as they are separate projects)  
```
npm run web
```
When it asks to be in a different port e.g.  
```
› Port 19000 is
? Use port 19001 instead? » (Y/n) 
```
And  
```
› Port 19006 is
? Use port 19007 instead? » (Y/n)
```
Press y for both  

To create QR codes to be used with the project use any free code generator online    
e.g. https://www.qr-code-generator.com/   
The link you want to use will be your local ip with the port mentioned in npm run web:  
http:// + 192.168.1.102:19006 + /table=*tablenumber*, e.g.   
http://192.168.1.102:19006/table=8  

Scan the code on your mobile device and enjoy the project!
