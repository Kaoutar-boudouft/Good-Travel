#!C:\Python310\python.exe
import smtplib
import sys
import json
import base64
from email.message import EmailMessage

#emailss=sys.argv[1]
#namess=sys.argv[2]
categorienamee=sys.argv[2]
tourtitlee=sys.argv[3]
city=sys.argv[4]
dated=sys.argv[5]
#capacite=sys[7]
#imagename=sys.argv[8]
#prix=sys.argv[9]

emails = json.loads(base64.b64decode(sys.argv[1]))
#names=namess.split('$')

categoriename=""
list1=categorienamee.split('.')
for x in list1:
    categoriename+=x
    categoriename+=" "

tourtitle=""
list2=tourtitlee.split('.')
for x in list2:
    tourtitle+=x
    tourtitle+=" "



def send_email(receiver, subject, message):
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    # Make sure to give app access in your Google account
    server.login('ctrlz.kaoutar.nouhaila@gmail.com', 'thebest2tdm')
    #instanciation d'un objet EmailMessage
    email = EmailMessage()
    email['From'] = 'Good Travel'
    email['To'] = receiver
    email['Subject'] = subject
    email.set_content(message)
    server.send_message(email)


email_list = {
    'kaoutar': 'kaoutarboudouft2@gmail.com',
    
}

   

def get_email_info_and_send(listemails):

    #message vocal
    #talk('Welcome start sending emails ')

    #receiver = get_email('k.azeggouar@gmail.com')
    subject = 'New Tour!'
    message =  "Categorie: "+categoriename+"\n\n"+"Tour Title: "+tourtitle+"\n\n"+"Discover That and More in Our Website:\n\n http://localhost/tra/index.php"
    for x in listemails:
        
        send_email(x, subject, message)


get_email_info_and_send(emails)