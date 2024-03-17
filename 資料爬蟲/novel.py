#https://sites.google.com/a/chromium.org/chromedriver/download
from selenium import webdriver
#模擬操作鍵盤
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
from bs4 import BeautifulSoup
import csv

# PATH = "C:/database/chromedriver/chromedriver.exe"
driver = webdriver.Chrome()

# driver.get("https://www.popo.tw/findbooks")
driver.get("https://www.ettoday.net/news/20231011/2600352.htm")
#輸入關鍵字並按enter
#search = driver.find_element(By.ID, 'searchterm')
#search.send_keys("穿越")
#search.send_keys(Keys.RETURN)

soup = BeautifulSoup(driver.page_source, 'html.parser')

all_data = []
book_name = 'div.story'
articles = soup.select(book_name)
for art in articles:
    all_data.append(art.get_text(strip=True, separator='|').split('|') )



#all_data = []

#bookname = driver.find_elements(By.CLASS_NAME, "row")
#for book in bookname:
#    all_data.append(book.get_text(strip=True, separator='|').split('|') )



# for page in range(10):
#     next = driver.find_element(By.CSS_SELECTOR, 'img[src = "https://cdn0.popo.tw/web1/images/icon-page-next.png"]')
#     next.click()

#     #WebDriverWait(driver, 10).until(
#     #    EC.presence_of_all_elements_located((By.CLASS_NAME, "wrap foot"))
#     #)
#     time.sleep(3)

#     soup = BeautifulSoup(driver.page_source, 'html.parser')
    
#     book_name = 'div.row'
#     articles = soup.select(book_name)
#     for art in articles[1:]:
#         all_data.append(art.get_text(strip=True, separator='|').split('|') )


for row in all_data[1:]:
    print(row)

time.sleep(3)

# with open('newData.csv', 'w', newline='', encoding = 'Utf-8') as csvfile:
#     spamwriter = csv.writer(csvfile, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
#     for row in all_data:
#         spamwriter.writerow(row)


driver.quit()