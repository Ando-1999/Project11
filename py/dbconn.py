# -*- coding: utf-8 -*-
"""
@author: Sparsh Katnoria

Contains python for connecting to server database
*Currently connects to an empty DB called "Project 11 Sample" with 
 username 'root' (default) and password 'root1'*
 
"""

# database connection
import pymysql

# Dev Note: May need tweaking for universal use
try:
    connection = pymysql.connect(host="localhost", user="project11", password="ToorToor1", database="projecttestdb", port=3306)
    mycursor=connection.cursor()
    
# raise error if connection failed

except pymysql.connect.Error as err:
    print("There was a connection error: {}".format(err))