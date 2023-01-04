from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait
import time
import re
import openpyxl
import numpy as np


driver = webdriver.Chrome()
driver.get('https://www.gongzicp.com/home/type-3.html')
time.sleep(1) #加了讓網頁整個開好才找得到標籤
# link0 = driver.find_element(By.ID, "fAcySem")
# link0.click()
# link01 = driver.find_element(By.XPATH, "//select[@id='fAcySem']/option[text()='110 學年度 第 2 學期']").click()
# link0.click()
# link = driver.find_element(By.ID, 'fType')
# link.click()
# link2 = driver.find_element(By.XPATH, "//select[@id='fType']/option[text()='學士班共同課程']").click()
# link.click()
# time.sleep(1)
# link3 = driver.find_element(By.ID, 'crstime_search').click()
# # WebDriverWait(driver, 20).until(
# #         EC.presence_of_element_located((By.CLASS_NAME, "label label-costype-15"))
# #     )
# time.sleep(15)
titles = driver.find_elements(By.NAME, "col-1")
time.sleep(1)
# titles2 = driver.find_elements(By.NAME, "brief")
# time.sleep(1)
# titles3 = driver.find_elements(By.NAME, "cos_credit")
# titles3.
i = 0
str = list(titles)
for title in titles:
    # print(title.text)
    str[i] = title.text.split("\n")
    i = i + 1

# k = 0
# str2 = list(titles2)
# for title2 in titles2:
#     # print(title2.text)
#     str2[k] = re.split("\n|,", title2.text)
#     k = k + 1
#
# j = 0
# str3 = list(titles3)
# for title3 in titles3:
#     # print(title2.text)
#     str3[j] = re.split("\n|,", title3.text)
#     j = j + 1
#
# str4 = list(titles)
# for j in range(k):
#     str4[j] = str[j]+str2[j]+str3[j]
#     # print(str3[j])
#
# # print(i)
# 利用 Workbook 建立一個新的工作簿
wb = openpyxl.Workbook()
sheet = wb.create_sheet("通識", 0)
sheet.append(["type"])
i = 0
for title in titles:
    sheet.append(tuple(str[i]))
    i = i + 1
wb.save('novel.xlsx')
driver.quit()