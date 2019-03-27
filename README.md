Role Name
=========

This role will install Red Hat Software Collections 

Requirements
------------

No special requirements for running the role. 

Role Variables
--------------

See `defaults/main.yml` for documentation of variables.  

Dependencies
------------

Probaby depends on config from `OULibraries/centos7`

Example Playbook
----------------

```
- hosts: d7-php7.dev.ec2.internal
  become: true
  roles:
    - role: OULibraries.sclmodphp
      tags: sclmodphp
```

License
-------

TBD

Author Information
------------------
Written and maintained by OU Libraries.
