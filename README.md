# Danvers
PHP based dynamic-site-generator. Yes it's blog-aware.

#The idea? 
It's damn simple. Focus on creating your content, in your favourite markup language (be it Markdown, Textile, or plain ol' HTML,) in the form of static files, and trust Danvers to display them. 

#Make more sense
And so I will! Once your site has been setup, the only folder you'd need to visit is the ```content``` folder.
An example of what a content folder of a Danvers site may look like:

```
Danvers/content
├── comments
│   └── approved
│       ├── 2001-03-10 17:16:18.2015-25-99.A weirdly dated post.md.json
│       ├── 2003-69-12 15:19:25.2015-25-99.A weirdly dated post.md.json
│       ├── 2016-07-26 02:53:40.2016-09-12.First post.html.json
│       └── 2016-07-26 02:54:03.2016-09-12.First post.html.json
├── pages
│   ├── about.html
│   ├── blog.md
│   ├── contact.textile
└── posts
    ├── 2013-02-19.An old post.textile
    ├── 2015-25-99.A weirdly dated post.md
    ├── 2016-05-13.A better post.markdown
    ├── 2016-09-12.First post.html
    └── 2016-09-13.Second post.html
```
#Features?
* Blog-aware, complete with category and author archives, permalinks and single-post pages. You name it!
* Textile and Markdown support.
* JSON based comments system.
* Grandma-Compatible.

#Getting Started:
1. Clone the repo or Download the files.
2. Read the grandma-compatible documentation. (Coming soon!) 
3. Make your changes. Create your content.
4. Deploy the files on the Web-Server. Deploying is merely a matter of copying the files. 
5. Proudly present your Danvers site to the world!

