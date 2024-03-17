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

PATH = "C:/database/chromedriver/chromedriver.exe"
driver = webdriver.Chrome(PATH)

driver.get("https://www.popo.tw/findbooks")
#輸入關鍵字並按enter
#search = driver.find_element(By.ID, 'searchterm')
#search.send_keys("穿越")
#search.send_keys(Keys.RETURN)

soup = BeautifulSoup(driver.page_source, 'html.parser')

all_data = []
book_name = 'div.forradio'
articles = soup.select(book_name)
for art in articles[1:]:
    all_data.append(art.get_text(strip=True, separator='|').split('|') )


for row in all_data[1:]:
    print(row)

time.sleep(3)

with open('popo_tag.csv', 'w', newline='', encoding = 'Utf-8') as csvfile:
    spamwriter = csv.writer(csvfile, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
    spamwriter.writerow(['作品標籤'])
    for row in all_data:
        spamwriter.writerow(row)


driver.quit()