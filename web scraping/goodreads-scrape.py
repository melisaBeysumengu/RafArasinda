from urllib.request import urlopen
from bs4 import BeautifulSoup
import mysql.connector
import csv

#connect to the database
cnx= mysql.connector.connect( user ='irem',password='irem_123',host='161.9.134.140',database='irem_db' )    
mycursor = cnx.cursor()
SQL3 = "CREATE TABLE genre (id int PRIMARY KEY AUTO_INCREMENT, genre varchar(50))"
SQL = "CREATE TABLE Publisher (id int PRIMARY KEY AUTO_INCREMENT, name varchar(50))"
SQL1 = "CREATE TABLE Author (id int PRIMARY KEY AUTO_INCREMENT, first_name varchar(50),second_name varchar(50))"
SQL2 = "CREATE TABLE Book (book_id int PRIMARY KEY AUTO_INCREMENT,genre_id int , FOREIGN KEY(genre_id) REFERENCES genre(id),url varchar(300),title varchar(100),author_id int,FOREIGN KEY(author_id) REFERENCES Author(id),img varchar(300),publishedDate varchar(50),publisher_id int, FOREIGN KEY(publisher_id) REFERENCES Publisher(id),ratingVal varchar(100),ratingcount varchar(100))"

Q1 = """INSERT INTO publisher(publisher_name) VALUES (%s)"""
Q2 = """INSERT INTO author (first_name,second_name) VALUES(%s,%s)"""
Q3 = """INSERT INTO  books (genre_id,url,title,author_ID,img,publishedDate,publisher_ID,ratingVal,ratingcount) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"""

def check_acontains(first_name,second_name):
    que = "SELECT EXISTS(SELECT Author_ID FROM author WHERE first_name=%s AND second_name=%s)"
    mycursor.execute(que,(first_name,second_name))
    result=mycursor.fetchone()
    for row in result:
        if row==1:
            return 1
        elif row==0:
            return 0

def check_pcontains(name):
    que = "SELECT EXISTS(SELECT publisher_ID FROM publisher WHERE publisher_name=%s)"
    mycursor.execute(que,(name,))
    result=mycursor.fetchone()
    for row in result:
        if row==1:
            return 1
        elif row==0:
            return 0

   
def geta_id(first_name,second_name):
    query="SELECT Author_ID FROM author WHERE first_name=%s AND second_name=%s"
    mycursor.execute(query,(first_name,second_name))
    result=mycursor.fetchone()
    for row in result:
        return row

    
def getp_id(name):
    query="SELECT publisher_ID FROM publisher WHERE publisher_name=%s"
    mycursor.execute(query,(name,))
    result=mycursor.fetchone()
    for row in result:
        return row

    
def bookinfo(book_arr,book_url,title,authorName,img,publishedDate):

    generalurl="https://www.bookdepository.com/"
    url=generalurl + book_url
    html=urlopen(url)
    soup =BeautifulSoup(html,"html.parser") 
    info = soup.find("div",{"class":"item-info"})
    ratingVal =((info.find("div",{"class":"rating-wrap hidden-md"})).find("span",itemprop="ratingValue")).get_text()
    ratingcount=((info.find("div",{"class":"rating-wrap hidden-md"})).find("span",{"class":"rating-count"})).get_text().strip()
    publisher=(soup.find("div",{"class":"biblio-info-wrap"})).find("ul",{"class":"biblio-info"})
    publisherName=publisher.find("span",itemprop="publisher")["itemscope"]
    #descrp=(soup.find("div",{"class":"item-description"})).find("div",itemprop="description").get_text().strip()
    genre= "Classics"
    genre_id =5
    fullname =authorName.split(" ")
    first_name=fullname[0]
    second_name=fullname[1]
    pcheck =check_pcontains(publisherName)
    acheck =check_acontains(first_name,second_name)
    if pcheck == 0:
       
        if acheck == 0:
            mycursor.execute(Q2,(first_name,)+ (second_name,))
            last_author_id=mycursor.lastrowid
            mycursor.execute(Q1,(publisherName,))
            last_publisher_id=mycursor.lastrowid
            book_arr.append((genre_id,url,title,last_author_id,img,publishedDate,last_publisher_id,ratingVal,ratingcount))
        else:
            mycursor.execute(Q1,(publisherName,))
            last_publisher_id=mycursor.lastrowid
            last_author_id=geta_id(first_name,second_name)
            book_arr.append((genre_id,url,title,last_author_id,img,publishedDate,last_publisher_id,ratingVal,ratingcount))

            
    else:
       
        if acheck == 0:
            mycursor.execute(Q2,(first_name,)+ (second_name,))
            last_author_id=mycursor.lastrowid
            last_publisher_id=getp_id(publisherName)
            book_arr.append((genre_id,url,title,last_author_id,img,publishedDate,last_publisher_id,ratingVal,ratingcount))

            

        else:
            last_author_id=geta_id(first_name,second_name)
            last_publisher_id=getp_id(publisherName)
            book_arr.append((genre_id,url,title,last_author_id,img,publishedDate,last_publisher_id,ratingVal,ratingcount))
         
   
        
#writer.writerow((genre_id,url,title,last_author_id,img,publishedDate,last_publisher_id,ratingVal,ratingcount))
    

def pagescrape(pageurl,book_arr):
   
    url="https://www.bookdepository.com/category/335/Classics" +pageurl
    html=urlopen(url)
    soup =BeautifulSoup(html,"html.parser")

    books = soup.findAll("div",{"class":"book-item"})
    #print(books[0].find("meta",  itemprop="name")["content"])
    #print((books[0].find("div",{"class":"item-img"})).a.attrs['href'])
    #(books[0].find("div",{"class":"item-img"}))

    #img=print((books[0].find("div",{"class":"item-img"})).a.find(books[0].find("img",{"class":"lazy loaded"})).attrs["data-lazy"])
    #publishedDate=((books[0].find("div",{"class":"item-info"})).find("p",{"class":"published"})).get_text().strip()
    
    try:    
        for book in books:
            title=book.find("meta",  itemprop="name")["content"]
            isbn=book.find("meta",  itemprop="isbn")["content"]
            bookurl=(book.find("div",{"class":"item-img"})).a.attrs['href']
            img=(book.find("div",{"class":"item-img"})).a.find(books[0].find("img",{"class":"lazy loaded"})).attrs["data-lazy"]
            author=(book.find("div",{"class":"item-info"})).find("p",{"class":"author"})
            authorName =(author.find("span",itemprop="name")).get_text()
            publishedDate=((book.find("div",{"class":"item-info"})).find("p",{"class":"published"})).get_text().strip()
            bookinfo(book_arr,bookurl,title,authorName,img,publishedDate)
           
            
         
    
    finally:
        print("CRAWLING IS FINISHED .")
        return book_arr    


  
book_arr = pagescrape("",[])
#mycursor.execute(SQL3)
#mycursor.execute(SQL)
#mycursor.execute(SQL1)
#mycursor.execute(SQL2)
mycursor.executemany(Q3,book_arr)
cnx.commit()
mycursor.close()
cnx.close()

print("DATABASE INSERTING IS FINISHED .")




    


