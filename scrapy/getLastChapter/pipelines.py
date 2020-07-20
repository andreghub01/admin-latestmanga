# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
import requests
import json

class GetlastchapterPipeline(object):
    def process_item(self, item, spider):
        url = "http://45.76.154.59:8080/api/comic/" + item['id_comic']
        headers = {'Authorization': None, "Content-Type": "application/json"}
        data = {
                    "rating" : item['rating'],
                    "language" : item['language']
                }
        requests.put(url, data=json.dumps(data), headers=headers)
        return item
