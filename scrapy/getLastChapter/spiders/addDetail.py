import scrapy
import requests
import json

class AdddetailSpider(scrapy.Spider):
    name = 'addDetail'
    def start_requests(self):
        response = requests.get("http://45.76.154.59:8080/api/comic?all=true")
        json_response = response.json()

        json_response = json_response['data']
        for item in json_response:
            response_comic = requests.get("http://45.76.154.59:8080/api/result?id_comic=" + str(item['id']) +"&id_web=14")
            json_response_comic = response_comic.json()
            json_response_comic = json_response_comic['data']['results']
            
            if json_response_comic:
                domain = 'http://' + json_response_comic['web']['url'] + json_response_comic['short_url']
                yield scrapy.Request(url=domain,callback = self.parse, meta={'id_comic' : item['id'], 'url':domain})
    
    # def response_is_ban(self, request, response):
    #     return b'banned' in response.body

    # def exception_is_ban(self, request, exception):
    #     return None
    
    def parse(self, response):
        value1=response.xpath('//span[@class="ratings"]/text()').extract_first()
        value2=response.xpath('//span[@class="ratings"]/span/text()').extract_first()
        rating = value1+value2
        rating = str(rating).replace('\t','').replace('\n','').replace('\r','')

        language = "English"

        url = "http://45.76.154.59:8080/api/comic/" + str(response.meta['id_comic'])
        headers = {'Authorization': None, "Content-Type": "application/json"}
        data = {
                    "rating" : rating,
                    "language" : language
                }
        requests.put(url, data=json.dumps(data), headers=headers)

        data = {
                    "url": response.url,
                    'api':url,
                    "rating" : rating,
                    "language" : language
                }
        yield data
