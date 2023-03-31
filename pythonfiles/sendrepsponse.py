#!C:\Python310\python.exe
import smtplib
import sys
#import speech_recognition as sr
#import pyttsx3
from email.message import EmailMessage

"""listener = sr.Recognizer()
engine = pyttsx3.init()


def talk(text):
    engine.say(text)
    engine.runAndWait()"""

"""sendto=sys.argv[1]
subj=sys.argv[2]
msg=sys.argv[4]"""
"""def get_email(email):
   return email.lower()"""


sendto=sys.argv[1]
subjj=sys.argv[2]
msgg=sys.argv[3]
msg=""
subj=""
list1 = msgg.split('.')
for x in list1:
    msg+=x
    msg+=" "


list2 = subjj.split('.')
for y in list2:
    subj+=y
    subj+=" "


"""for i in range(3,len(sys.argv)): 
    msg+=sys.argv[i]
    msg+=" """

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





def get_email_info_and_send(email): #listemails kan3tiha f parametres list de les email ana fhad lhala testit ri bwahd

    #message vocal
    #talk('Welcome start sending emails ')

    #receiver = get_email('k.azeggouar@gmail.com')
    subject = subj
    message = msg
    send_email(email, subject, message)
    """for cle, receiver in listemails.items():
        print("email : ", receiver)
        send_email(receiver, subject, message)"""


get_email_info_and_send(sendto)