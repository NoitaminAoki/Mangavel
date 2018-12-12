var Manga = require('../models/mangaModel'),
    path = require("path")

exports.create = (req, res) => {
    if(!req.body.sinopsis) {
        return res.status(400).send({
            message: "Note sinopsis can not be empty"
        })
    }

    // Create a Note
    var manga = new Manga(req.body)

    // Save Note in the database
    manga.save()
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

exports.findAll = (req, res) => {
    Manga.find()
    .sort({createdAt: -1})
    // .populate('chapter')
    .then(notes => {
        res.send(notes)
        // res.sendFile(path.resolve('templates/manga.html'))
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving notes."
        })
    })
}

exports.findOne = (req, res) => {
    Manga.findById(req.params.mangaId)
    .then(note => {
        if(!note) {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })            
        }
        res.send(note)
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })                
        }
        return res.status(500).send({
            message: "Error retrieving note with id " + req.params.mangaId
        })
    })
}

exports.update = (req, res) => {
    // Validate Request
    if(!req.body.sinopsis) {
        return res.status(400).send({
            message: "Note sinopsis can not be empty"
        })
    }

    // Find note and update it with the request body
    Manga.findByIdAndUpdate(req.params.mangaId, req.body, {new: true})
    .then(note => {
        if(!note) {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })
        }
        res.status(200).send({
            status: 200,
            message: "Success updating manga."
        })
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })                
        }
        return res.status(500).send({
            message: "Error updating note with id " + req.params.mangaId
        })
    })
}

exports.delete = (req, res) => {
    Manga.findByIdAndRemove(req.params.mangaId)
    .then(note => {
        if(!note) {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })
        }
        res.status(200).send({
            status: 200,
            message: "Note deleted successfully!"
        })
    }).catch(err => {
        if(err.kind === 'ObjectId' || err.name === 'NotFound') {
            return res.status(404).send({
                message: "Note not found with id " + req.params.mangaId
            })                
        }
        return res.status(500).send({
            message: "Could not delete note with id " + req.params.mangaId
        })
    })
}
