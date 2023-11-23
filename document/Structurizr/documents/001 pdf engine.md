## Test pdf engine

- Engine xuất PDF được module hóa, có thể được switch dễ dàng
- Có 2 engine tích hợp sẵn trong core: tcpdf và dompdf. Enginee xịn nhất: Snappy https://github.com/KnpLabs/snappy
- Có thể tự viết engine mới
- Add thêm font vào pdf engine
- Add template helper

## Fix lỗi tiếng việt
- Tiếng Việt khi dùng các font hầu hết đều bị lỗi, kể cả dùng google font có hỗ trợ tiếng Việt như roboto, open sans 

## Tham khảo
- php pdf lib: https://ourcodeworld.com/articles/read/226/top-5-best-open-source-pdf-generation-libraries-for-php
- google font: https://github.com/dubas-pro/ext-dubas-google-fonts
- template helper dịch chuỗi: https://github.com/dubas-pro/ext-template-helper
- ví dụ tcpdf: https://tcpdf.org/examples/example_061/
- add custom emoji to template: https://forum.espocrm.com/forum/general/84550-pdf-template-fonts-unicode-emoji