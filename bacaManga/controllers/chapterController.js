var Chapter = require('../models/chapterModel')
var Manga = require('../models/mangaModel')
var Image = require('../models/imageModel')

exports.create = (req, res) => {
    // Create a Note
    var chapter = new Chapter(req.body)
    
    // Save Note in the database
    chapter.save()
    .then(data => {
        req.body.image.forEach((element, index) => {
            var image = new Image({
                chapter: data._id,
                name: element,
                nomor: (index+1)
            })
            image.save()
        })
        res.status(200).send({
            status: 200,
            message: "Success adding data."
        })
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while creating the chapter."
        })
    })
}

exports.findAll = (req, res) => {
    Chapter.find()
    .then(data => {
        res.send(data)
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving notes."
        })
    })
}

exports.findAllByManga = (req, res) => {
    Chapter.find({manga: req.params.mangaId})
    .sort({nomor: -1})
    .then(data => {
        var allData
        
        Manga.find({_id: req.params.mangaId}, (err, docs) => {
            setDataManga(docs[0])
        })
        
        function setDataManga(data2) {
            allData = {
                manga: data2,
                chapter: data
            }
            
            res.send(allData)
        }
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occured while retrieving data."
        })
    })
}

exports.findAllAndCount = (req, res) => {
    Chapter.aggregate([
        { $group: { _id: { manga: "$manga"},total:{$sum: 1} } }
    ])
    .then(data => {
        // res.send(data)
        Manga.populate(data, {path: '_id'})
        .then(newData => {
            res.send(newData)
        }).catch(err => {
            res.status(500).send({
                message: err.message || "Some error occurred while retrieving notes."
            })
        })
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving notes."
        })
    })
}

exports.findOne = (req, res) => {
    var idChapter = req.params.chapterId,
    allData
    Chapter.findById(idChapter)
    .populate('manga')
    .then(data => {
        if(!data) {
            return res.status(404).send({
                message: "Chapter not found with id " + req.params.chapterId
            })            
        }
        Image.find({ chapter: idChapter}, null, {sort: {nomor: 1}}, (err, docs) => {
            if(err) {
                return res.status(503).send({
                    message: err.message || "Error"
                })
            }
            allData = {
                chapter: data,
                image: docs
            }
            res.send(allData)
        })
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Chapter not found with id " + req.params.chapterId
            })                
        }
        return res.status(500).send({
            message: "Error retrieving chapter with id " + req.params.chapterId
        })
    })
}

exports.update = (req, res) => {
    // Find note and update it with the request body
    Chapter.findOneAndUpdate({_id: req.params.chapterId}, req.body, {new: true})
    .then(data => {
        if(!data) {
            return res.status(404).send({
                message: "Chapter not found with id " + req.params.chapterId
            })
        }
        // req.body.file.id.forEach((element, index) => {
            // dataImage[index] = element
            // if(element == "new") {
            //     var image = new Image({
            //         chapter: data._id,
            //         name: req.body.file.image[index],
            //         nomor: (rows+1)
            //     })
            //     image.save()
            // } else{
            //     if(req.body.file.image[index]) {
            //         var asd = async function() {
            //             await Image.findByIdAndUpdate(element, { name: req.body.file.image[index], nomor: (rows+1)}, {new: true})
            //             .then(docs => {
            //                 dataImage[index] = docs.name
            //             })
            //         }
            //         asd()
            //     } else{
            //         Image.findByIdAndUpdate(element, { nomor: (rows+1)}, {new: true}).exec()
            //     }
            // }
        // })
        
        res.status(200).send({
            status: 200,
            message: "success"
        })
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Chapter not found with id " + req.params.chapterId
            })                
        }
        return res.status(500).send({
            message: err.message + " Error updating chapter with id " + req.params.mangaId
        })
    })
}

exports.delete = (req, res) => {
    Chapter.findByIdAndRemove(req.params.chapterId)
    .then(data => {
        if(!data) {
            return res.status(404).send({
                message: "Chapter not found with id " + req.params.chapterId
            })
        }
        res.status(200).send({
            status: 200,
            message: "Chapter deleted successfully!"
        })
    }).catch(err => {
        if(err.kind === 'ObjectId' || err.name === 'NotFound') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.chapterId
            })                
        }
        return res.status(500).send({
            message: "Could not delete note with id " + req.params.chapterId
        })
    })
}

exports.tester = (req, res) => {
    var data = [];
    for(var i = 0;i < 3; i++) {
        data[i] = this.testerlagi(req.params.chapterId)
    }
    
    res.send({
        result: data
    })
}

exports.testerlagi = (id) => {
    var data = [];
    Chapter.findById(id, (err, docs) => {
        data = docs
    })

    return data
}

