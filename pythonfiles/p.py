#!C:\Python310\python.exe
import socket
import requests
"""hostname=socket.gethostname()
ipAddr=socket.gethostbyname(hostname)"""#had l partie katjib l ip adresse sa3a jbart bli aslan had lien kayjibo l raso!
reponse=requests.get("http://ip-api.com/json/").json()
print(reponse['country']+" "+reponse['city'])
