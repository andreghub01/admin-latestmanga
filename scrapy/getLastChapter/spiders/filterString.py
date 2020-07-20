last_chapter = "Chapter 485: [Season 3] Ep. 68"

# last_chapter = last_chapter.replace("ch.","Ch ")
search = last_chapter.find(":")
if search > 0 :
    last_chapter = last_chapter[:search]

print(last_chapter)