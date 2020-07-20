import scrapy
import requests
import json

class DetailcomicSpider(scrapy.Spider):
    name = 'detailComicPerComic'
    
    def start_requests(self):
        id_comic = "55"
        response_comic = requests.get("http://45.76.154.59:8080/api/result?id_comic=" + id_comic +"&id_web=2")
        json_response_comic = response_comic.json()
        json_response_comic = json_response_comic['data']['results']
        
        if json_response_comic:
            domain = 'http://' + json_response_comic['web']['url'] + json_response_comic['short_url']
            yield scrapy.Request(url=domain,callback = self.parse, meta={'id_comic' : id_comic, 'url':domain})
    
    # def response_is_ban(self, request, response):
    #     return b'banned' in response.body

    # def exception_is_ban(self, request, exception):
    #     return None
    
    def parse(self, response):
        content = response.xpath('//body//div[@id="noidungm"]/text()').extract_first()
        content = (content)
        content = content.replace('\r','').replace('\n','').replace('  ','')

        alternative = response.xpath('//body//div[@class="listinfo"]//li[1]/text()').extract_first()
        alternative = str(alternative)
        alternative = alternative.replace(':','')

        author = response.xpath('//body//div[@class="listinfo"]//li[3]/text()').extract_first()
        author = str(author)
        author = author.replace(':','')

        views = response.xpath('//body//div[@class="listinfo"]//li[4]/text()').extract_first()
        views = str(views)
        views = views.replace(':','')

        detail_status = response.xpath('//body//div[@class="listinfo"]//li[5]/text()').extract_first()
        detail_status = str(detail_status)
        detail_status = detail_status.replace(':','')

        genres = response.xpath('//body//div[@class="listinfo"]//li[6]/a/text()').extract()
        genres = ','.join(genres)

        image = response.xpath('//body//div[@class="imgdesc"]/img/@src').extract_first()
        image = str(image).replace("https:","")
        image = "https:" + image

        url = "http://45.76.154.59:8080/api/comic/" + response.meta['id_comic']
        headers = {'Authorization': None, "Content-Type": "application/json"}
        data = {
                    "content" : content,
                    "alternative" : alternative,
                    "author" : author,
                    "views" : views,
                    "detail_status" : detail_status,
                    "genres" : genres,
                    "image" : image
                }
        requests.put(url, data=json.dumps(data), headers=headers)

        data = {
                    # "id" : response.meta['id_comic'],
                    'url' : response.meta['url'],
                    'url_api' : url,
                    'header' : headers,
                    "content" : content,
                    "alternative" : alternative,
                    "author" : author,
                    "views" : views,
                    "detail_status" : detail_status,
                    "genres" : genres,
                    "image" : image
                }
        yield data
