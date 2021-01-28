
from urllib.request import urlopen
from bs4 import BeautifulSoup
import mysql.connector

#connect to the database
cnx= mysql.connector.connect( user ='irem',password='irem_123',host='161.9.134.140',database='irem_db' )    
cursor = cnx.cursor()
sql = """INSERT INTO  books (genre_id,url,title,author_id,img,publishedDate,publisher_id,ratingVal,ratingcount) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"""
                  
                 

def bookinfo(book_arr,book_url,title, isbn, authorName,img,publishedDate):

   

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
        genre= "classics"
        book_arr.append((genre,url,title,authorName,isbn,img,publishedDate,publisherName,ratingVal,ratingcount))
       # writer.writerow((genre,title,authorName,isbn,img,publishedDate,publisherName,ratingVal,ratingcount,descrp))
    

def pagescrape(pageurl,book_arr):
   
    url="https://www.bookdepository.com/category/335/Classics" +pageurl
    html=urlopen(url)
    soup =BeautifulSoup(html,"html.parser")

    books = soup.findAll("div",{"class":"book-item"})
    # print(books[0].find("meta",  itemprop="name")["content"])
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
            bookinfo(book_arr,bookurl,title, isbn, authorName,img,publishedDate)
         
    
    finally:
        print("CRAWLING IS FINISHED .")
        return book_arr     

book_arr = pagescrape("",[])
print(len(book_arr))
cursor.executemany(sql,book_arr)
cnx.commit()
cursor.close()
cnx.close()
print("DATABASE INSERTING IS FINISHED .")




    


