## Test pdf engine

- Engine xuất PDF được module hóa, có thể được switch dễ dàng
- Có 2 engine tích hợp sẵn trong core: tcpdf và dompdf. Enginee xịn nhất: Snappy https://github.com/KnpLabs/snappy
- Có thể tự viết engine mới
- Add thêm font vào pdf engine
- Add template helper

## Reverse Engineer
- File chịu trách nhiệm gen pdf: `  Espo\Tools\Pdf\Service; `
- Với 1 entity, có thể định nghĩa hàm để lấy các field thêm phục vụ cho việc in ấn trong service của entityType đó:  ` loadAdditionalFields,   loadAdditionalFieldsForPdf`

## Fix lỗi tiếng việt
- Khi build font lưu ý  để TrueTypeUnicode sẽ không bị lỗi. 
1. Khi build TCPDF có thể để trống type để hàm build tự nhận
    - Nếu đã build từ trước cần xóa file build cũ để build lại trong folder: ` site\vendor\tecnickcom\tcpdf\fonts `
    - Cần cho quyền ghi folder build: ` site\vendor\tecnickcom\tcpdf\fonts `.
    - Folder build đã fix không custom được. Về lý thuyết có thể custom bằng cách định nghĩa hằng số: ` K_PATH_FONTS `

## Tham khảo
- php pdf lib: https://ourcodeworld.com/articles/read/226/top-5-best-open-source-pdf-generation-libraries-for-php
- google font: https://github.com/dubas-pro/ext-dubas-google-fonts
- template helper dịch chuỗi: https://github.com/dubas-pro/ext-template-helper
- ví dụ tcpdf: https://tcpdf.org/examples/example_061/
- add custom emoji to template: https://forum.espocrm.com/forum/general/84550-pdf-template-fonts-unicode-emoji