# OCXPak - OpenCart eXtension Packer

## Description
A custom dev-tool for more conveniently storing the source code of developed OpenCart extensions on GitHub and packing them into zip files. Required PHP.

Able to replace text in source files, which is convenient when adding identical words and texts, such as the name of a module, version or an infoblock at the beginning of a file.
The constants defined in the `_ocxpak.php` file are used for replacement. All it needs for replacement is to define a constant and insert it in the right place of the source file using the `<insertvar>` tag (for example, `<insertvar>CONST</insertvar>`, this construction will be replaced with the value of `CONST` defined in the file `_ocxpak.php`). If it needs to insert content of a whole file use the `<insertfile>` tag(for example, `<insertfile>_inc/info.txt</insertfile>` ). The `<insertvar>` tag also works inside such files - first all the variables will be substituted in a file and then its contains will be inserted in the appropriate place.

An example of directory structure:
```
.
├── _fcl
│   └── module.fcl.g
├── _inc
│       include0.txt
│       include1.txt
├── _ocxpak
│       conf.php
│       func.php
│       help.php
│       reqd.php
├── addons
│   └── addon1
│       ├── src
│       │   ├── 23
│       │   │   ├── upload
│       │   │   ├── admin
│       │   │   └── catalog
│       │   │   └── install.xml
│       │   ├── 3
│       │   │   ├── upload
│       │   │   ├── admin
│       │   │   └── catalog
│       │   │   └── install.xml
│       │   ├── 4
│       │   │   ├── admin
│       │   │   ├── catalog
│       │   │   └── ocmod
│       │   │       └── addon.ocmod.xml
│       └── zip
│           ├── module--addon1-oc23.ocmod.zip
│           ├── module--addon1-oc3x.ocmod.zip
│           └── module--addon1-oc4x.ocmod.zip
├── module
│   ├── src
│   │   ├── 23
│   │   │   ├── upload
│   │   │   ├── admin
│   │   │   └── catalog
│   │   │   └── install.xml
│   │   ├── 3
│   │   │   ├── upload
│   │   │   ├── admin
│   │   │   └── catalog
│   │   │   └── install.xml
│   │   └── 4
│   │       ├── admin
│   │       ├── catalog
│   │       └── ocmod
│   │           └── addon.ocmod.xml
│   └── zip
│       ├── module-oc23.ocmod.zip
│       ├── module-oc3x.ocmod.zip
│       └── module-oc4x.ocmod.zip
├── .fclignore
├── _ocxpak.def.php
└── _ocxpak.php
```

`_fcl`- A storage of `fcl`-file - a custom archive that contains all the necessary project files and has a git-friendly structure. Using to encrypt and store project files using git. It requires 3rd party tools and is not yet publicly available (maybe later).  
`_inc` - A directory to store placeholder files are used with the `<insertfile>` tag.  
`src` - A directory to store module or addon source files  
`zip` - A directory where the compiled extension `zip`-file is created.  
`.fclignore` - A list of files to be ignored by the `fcl`-utility. It is not yet publicly available.  
`_ocxpak.def.php` - A file with defined constants to use them with the `<insertvar>` tag.
