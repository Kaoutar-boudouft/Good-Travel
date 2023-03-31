#!C:\Python310\python.exe
import smtplib
import sys
from email.message import EmailMessage

user=sys.argv[1]
email=sys.argv[2]
password=sys.argv[3]

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

def get_email_info_and_send(email):

    #message vocal
    #talk('Welcome start sending emails ')

    #receiver = get_email('k.azeggouar@gmail.com')
    subject = 'Recuperer votre mot de pass'
    message =  user+" Your Password is: "+password
    send_email(email, subject, message)


get_email_info_and_send(email)