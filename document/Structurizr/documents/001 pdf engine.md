## Test pdf engine

- Engine xuất PDF được module hóa, có thể được switch dễ dàng
- Test thử 2 engine tích hợp sẵn trong core: tcpdf và dompdf. Enginee xịn nhất: Snappy https://github.com/KnpLabs/snappy
- Có thể tự viết engine mới
- Add thêm font vào pdf engine
- Add template helper: hàm dịch string
- render template là file .html

## Reverse Engineer
- File chịu trách nhiệm gen pdf: `  Espo\Tools\Pdf\Service; `
- Với 1 entity, có thể định nghĩa hàm để lấy các field thêm phục vụ cho việc in ấn trong service của entityType đó:  ` loadAdditionalFields,   loadAdditionalFieldsForPdf`

## Fix lỗi tiếng việt
- Khi build font lưu ý  để TrueTypeUnicode sẽ không bị lỗi. 
1. Khi build TCPDF có thể để trống type để hàm build tự nhận
    - Nếu đã build từ trước cần xóa file build cũ để build lại trong folder: ` site\vendor\tecnickcom\tcpdf\fonts `
    - Cần cho quyền ghi folder build: ` site\vendor\tecnickcom\tcpdf\fonts `.
    - Folder build đã fix không custom được. Về lý thuyết có thể custom bằng cách định nghĩa hằng số: ` K_PATH_FONTS `

## Thêm Template helper
### dubasTranslate helper
This helper will let you get label of field in specific language.
You just need to add this string to your template:

`{{dubasTranslate scope='Task' category='fields' label='createdAt' language='de_DE'}}`

**Parameters:**
+ `dubasTranslate` - name of helper;
+ `scope` - Scope from Label Manager;
+ `category` - Category from scope which you set above;
+ `label` - name of field which you want to translate;
+ `language` - optional language parameter which determine in which you want to get translation. If you don't use this parameter, helper will use as default `en_US`.

### dubasTranslateOption helper
This helper will let you get label for fields with options.
You just need to add this string to your template:

`{{dubasTranslateOption scope='Task' field='status' value='Canceled' language='de_DE'}}`

**Parameters:**
+ `dubasTranslateOption` - name of helper;
+ `scope` - Scope from Label Manager;
+ `field` - Name of field with options;
+ `value` - Name of options; 
+ `language` - optional language parameter which determine in which you want to get translation. If you don't use this parameter, helper will use as default `en_US`.

### dubasTranslateValue helper
This helper will let you get label in specific language for actual value of field with options.
You just need to add this string to your template:

`{{dubasTranslateValue id scope='Task' field='status' language='pl_PL'}}`

**Parameters:**
+ `dubasTranslateValue` - name of helper;
+ `id` - id of specific record which will let us fetch value of field;
+ `scope` - Scope from Label Manager;
+ `field` - Name of field with options;
+ `language` - optional language parameter which determine in which you want to get translation. If you don't use this parameter, helper will use as default `en_US`.

### sttIncre
- Hàm đếm số để đánh stt trong bảng

**Parameters:**
+ `sttIncre` - tên hàm;
+ `start` - giá trị khởi tạo;
+ `increase` - giá trị tăng thêm;
+ `get` - có trả về giá trị không. nếu `get=true` thì trả về giá trị hiện tại;

### renderTemplate
- Hàm render 1 template bất kỳ bên ngoài và trả về $html render được

## Tham khảo
- php pdf engine lib: https://ourcodeworld.com/articles/read/226/top-5-best-open-source-pdf-generation-libraries-for-php
- google font extension: https://github.com/dubas-pro/ext-dubas-google-fonts
- template helper dịch chuỗi extension: https://github.com/dubas-pro/ext-template-helper
- ví dụ tcpdf: https://tcpdf.org/examples/example_061/
- add custom emoji to template: https://forum.espocrm.com/forum/general/84550-pdf-template-fonts-unicode-emoji