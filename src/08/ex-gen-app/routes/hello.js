const express = require("express");
const multer = require("multer");
const path = require("path");
const fs = require("fs");
const exifr = require("exifr");
const { Console } = require("console");
const MediaInfo = require("mediainfo.js");
const ffmpeg = require("fluent-ffmpeg");

const router = express.Router();

// フォームデータを処理するためのMulterの設定
const storage = multer.memoryStorage();
const upload = multer({ storage: storage });

router.use(express.static("public"));

router.get("/", (req, res, next) => {
  fs.writeFile("./routes/test.txt", "Hello!", function (err) {
    if (err) {
      throw err;
    }
    console.log("test.txtが作成されました");
  });
  var data = {
    title: "Hello!",
    content: "これは、サンプルのコンテンツです。<br>this is sample content.",
  };
  res.render("hello", data);
});

router.post("/", upload.single("video"), (req, res) => {
  // フォームからの動画データを受信
  const videoData = req.file.buffer;

  console.log(req.file);

  // ターゲットディレクトリ
  const targetDirectory = "./video";

  // ターゲットディレクトリが存在しない場合は作成
  if (!fs.existsSync(targetDirectory)) {
    fs.mkdirSync(targetDirectory);
  }

  // 動画ファイルのパスを作成
  const videoPath = path.join(targetDirectory, "uploaded_video.mp4");

  // 動画ファイルを作成
  fs.writeFile(videoPath, videoData, (err) => {
    if (err) {
      console.error("Error creating video file:", err);
      res.status(500).send("Internal Server Error");
    } else {
      console.log("Video file created successfully.");

      var ffprobe = require("ffprobe"),
        ffprobeStatic = require("ffprobe-static");

      ffprobe(
        "./uploaded_video.mp4",
        { path: ffprobeStatic.path },
        function (err, info) {
          // if (err) return done(err);
          console.log(info);
        }
      );

      // const videoBuffer = Buffer.from(videoData, "binary");
      // ffmpeg.ffprobe(videoBuffer, (err, metadata) => {
      //   if (err) {
      //     console.error("Error:", err);
      //   } else {
      //     const durationInSeconds = metadata.format.duration;
      //     console.log("Video Duration:", durationInSeconds, "seconds");
      //   }
      // });

      res.status(200).send("Video uploaded successfully.");
    }
  });
});

module.exports = router;
