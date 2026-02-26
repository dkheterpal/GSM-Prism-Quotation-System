const mammoth = require("mammoth");
const fs = require("fs");
const path = require("path");

const docxPath = "D:\\xampp\\htdocs\\Zoho\\Files\\Proposal GM PRISM Products v1 (1).docx";
const outPath = "D:\\xampp\\htdocs\\Zoho\\proposal-gsm-prism\\storage\\app\\public\\extracted.html";
const imgDir = "D:\\xampp\\htdocs\\Zoho\\proposal-gsm-prism\\public\\images\\products";

if (!fs.existsSync(imgDir)) {
    fs.mkdirSync(imgDir, { recursive: true });
}

let imageCounter = 1;

const options = {
    convertImage: mammoth.images.imgElement(function(image) {
        return image.read("base64").then(function(imageBuffer) {
            const ext = image.contentType.split("/")[1];
            const imageName = "img_" + imageCounter++ + "." + ext;
            const absolutePath = path.join(imgDir, imageName);
            
            fs.writeFileSync(absolutePath, Buffer.from(imageBuffer, 'base64'));
            
            return {
                src: "/images/products/" + imageName
            };
        });
    })
};

mammoth.convertToHtml({path: docxPath}, options)
    .then(function(result){
        const html = result.value; 
        fs.writeFileSync(outPath, html);
        console.log("HTML extracted:", html.substring(0, 100));
        console.log("Images extracted to", imgDir);
    })
    .catch(function(err){
        console.error(err);
    });
