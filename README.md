# PAK - OpenCart Extension Packer

## Description
A custom dev-tool for more conveniently storing the source code of developed OpenCart extensions on GitHub and packing them into zip files. Using PHP.

Able to replace text in source files, which is convenient when adding identical words and texts, such as the name of a module, version or an infoblock at the beginning of a file.
The constants defined in the `pakdef.php` file are used for replacement. All it needs for replacement is to define a constant and insert it in the right place of the source file using the `<insertvar>` tag (for example, `<insertvar>CONST</insertvar>`, this construction will be replaced with the value of `CONST` defined in the file `pakdef.php`). If it needs to insert content of a whole file use the `<insertfile>` tag(for example, `<insertfile>_inc_/info.txt</insertfile>` ). The `<insertvar>` tag also works inside such files.

Example of directory structure (for example it will be `oc-module`) :

- _fcl
  - oc-module.fcl.g
- _inc
  - include0.txt
  - include1.txt
- module
  - src
  - zip
    - oc-module.ocmod.zip
- addons
  - addon1
    - src
    - zip
      - oc-module--addon1.ocmod.zip
  - addon1
    - src
    - zip
      - oc-module--addon1.ocmod.zip
  - ...
- .fclignore
- pakdef.php

`_fcl`- Can be ignored now. `fcl`-file is a custom archive that contains all the necessary project files and has a git-friendly structure. It is encrypted by a custom utility for security. Requires two custom utilities that are not yet publicly available (I will post the source files of these utilities later).  
`_inc` - A directory to store placeholder files are used with the `<insertfile>` tag.  
`src` - A directory to store module or addon source files  
`zip` - A directory where the compiled extension `zip`-file is created.  
`.fclignore` - Can be ignored now. A list of files to be ignored by the `fcl`-utility.  
`pakdef.php` - A file with defined constants to use them with the `<insertvar>` tag.
