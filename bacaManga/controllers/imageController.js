var Image = require('../models/imageModel'),
Chapter = require('../models/chapterModel'),
path = require("path")

exports.create = (req, res) => {
    // Create a Note
    var image = new Image(req.body)
    
    // Save Note in the database
    image.save()
    .then(data => {
        res.status(200).send({
            status: 200,
            message: "Success adding data."
        })
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while creating the Note."
        })
    })
}

exports.findAllByChapter = (req, res) => {
    Image.find({'chapter' : req.params.chapterId})
    // .populate({
    //     path: 'chapter',
    //     populate: {
    //         path: 'manga'
    //     }
    // })
    .then(data => {
        Chapter.findById(req.params.chapterId).then(datachap => {
            var allData
            allData = {
                chapter: datachap,
                image: data
            }
            res.send(allData)
        })
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving notes."
        })
    })
}

exports.findOne = (req, res) => {
    Image.findById(req.params.imageId)
    .then(data => {
        if(!data) {
            return res.status(404).send({
                message: "Note not found with id " + req.params.imageId
            })            
        }
        res.send(data)
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.imageId
            })                
        }
        return res.status(500).send({
            message: "Error retrieving note with id " + req.params.imageId
        })
    })
}

exports.update = (req, res) => {
    
    // Find note and update it with the request body
    Image.findById(req.params.imageId).then(dataimage => {
        Image.findByIdAndUpdate(req.params.imageId, req.body, {new: true})
        .then(data => {
            if(!data) {
                return res.status(404).send({
                    message: "Note not found with id " + req.params.imageId
                })
            }
            res.status(200).send({
                status: 200,
                message: "Success updating manga.",
                result: dataimage.name
            })
        })
    })
    .catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.imageId
            })                
        }
        return res.status(500).send({
            message: "Error updating note with id " + req.params.imageId
        })
    })
}

exports.delete = (req, res) => {
    Image.findByIdAndRemove(req.params.imageId)
    .then(data => {
        if(!data) {
            return res.status(404).send({
                message: "Note not found with id " + req.params.imageId
            })
        }
        res.send({
            status: 200,
            name: data.name,
            message: "Note deleted successfully!"
        })
    }).catch(err => {
        if(err.kind === 'ObjectId' || err.name === 'NotFound') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.imageId
            })                
        }
        return res.status(500).send({
            message: "Could not delete note with id " + req.params.imageId
        })
    })
}
