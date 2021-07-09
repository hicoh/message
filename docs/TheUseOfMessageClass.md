# The Use Of Message Class

## Structure
|- [Message class](../src/Message.php)

```json
{
  "stream": {
    "user": {
      "additional_settings": []
    },
    "spec": {
      "id": "507da560-096a-11eb-b073-1343b5621e79",
      "organisation_id": "f603b920-89e9-11e9-b900-674d10427f9c",
      "title": "Faker Order Creation in Shopify",
      "transformation_id": "bd6c01d0-0969-11eb-9490-21df07059a67",
      "data_type": "auto_order",
      "test_mode": false
    },
    "source": {
      "system": "Shopify",
      "url": "Shopify",
      "key_id": "785953c0-89eb-11e9-91f2-55e2a8c02726",
      "function": "GetRandomProducts::fromShopify()",
      "trigger": "Manual",
      "options": null,
      "additional_settings": {
        "force_limit": 6,
        "random_limit": 3,
        "fake_error_failed": 1,
        "fake_error_aborted": 1
      }
    },
    "destination": {
      "system": "Ftp",
      "url": "Ftp",
      "key_id": "e4eaf2b0-bd93-11ea-b7a8-35159d9f97ec",
      "function": "PostFiles::toFtp()",
      "trigger": "Real Time",
      "options": null,
      "additional_settings": {
        "formatting": "xml",
        "filename_format": "Order_##DATETIMEEXACT##.xml",
        "remote_path": "\/simple-streets\/orders\/",
        "skip_path_check": true
      }
    }
  },
  "job": {
    "id": "12345",
    "stage": "source"
  },
  "event": {
    "id": ""
  },
  "payload": {
    "in": {
      "data": "",
      "path": ""
    },
    "out": {
      "data": "",
      "path": ""
    }
  }
}
```