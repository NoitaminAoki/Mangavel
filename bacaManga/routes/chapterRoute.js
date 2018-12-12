var chapterController = require('../controllers/chapterController')

module.exports = (app) => {
    var chapter = chapterController

    app.post('/chapter', chapter.create)
    app.get('/chapter', chapter.findAll)
    app.get('/chapter/manga/:mangaId', chapter.findAllByManga)
    app.get('/chapter/agg', chapter.findAllAndCount)
    app.get('/chapter/:chapterId', chapter.findOne)
    app.put('/chapter/:chapterId', chapter.update)
    app.delete('/chapter/:chapterId', chapter.delete)
    app.get('/chaptertest/:chapterId', chapter.tester)

}